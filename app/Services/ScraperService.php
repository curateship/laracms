<?php
namespace App\Services;

use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\{DB, File};
use Image, Imagick;
use FFMpeg\FFProbe;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\{X264, Ogg, WebM, WMV, WMV3};
use Illuminate\Support\Facades\Storage;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Log;
use App\Services\LoggerService;
use App\Models\{Post, ScraperLog, ScraperStat, Scraper, Tag, TagsCategories};

/**
 * @property $status
 */
class ScraperService {
  public $scraper = null;
  public $settings = null;
  public $domain = null;
  public $logger = null;
  public $proxies = [];

  public $scraper_status = [
    'id' => 0,
    'list_page' => '',
    'detail_page' => ''
  ];

  public function __construct($scraper, $settings) {
    $this->scraper = $scraper;
    $this->settings = $settings;

    $this->scraper_status['id'] = $this->scraper->id;

    if (isset($this->scraper->default_url)) {
      $url = parse_url($this->scraper->default_url);
      $this->domain = (isset($url['scheme']) ? $url['scheme'] : 'https') . '://' . (isset($url['host']) ? $url['host'] : '') . '/';

      $this->scraper_status['list_page'] = $this->scraper->default_url;
      $this->scraper_status['detail_page'] = '';
    }

    if (isset($this->settings['scraper_ip_ports']) || count($this->settings['scraper_ip_ports']) > 0) {
      foreach($this->settings['scraper_ip_ports'] as $proxy) {
        $this->proxies[] = sprintf('http://%s:%s', $proxy['ip'], $proxy['port']);
      }
    }

    $this->logger = new LoggerService($this->scraper->id);
  }

  public function run() {
    Scraper::where('id', $this->scraper->id)->update(['status' => 'running']);

    // Log::info('Prepare to run scraper...');

    // Validation (Non completed settings)
    /*if (!isset($this->settings['scraper_ip_ports']) || count($this->settings['scraper_ip_ports']) == 0) {
      Log::warning('Scraper is canceled, because could not find ip:port list.');
      $this->logger->update_log_param('proxy', 0);
      $this->logger->save_log(false);
      return;
    }*/

    // Validation (Invalid scraper)
    if (!isset($this->scraper->default_url)) {
      Log::warning('Scraper is canceled, because could not find main list page url.');
      $this->logger->update_log_param('default_url', 0);
      $this->logger->save_log(false);
      return;
    }

    // Check if the scraper was paused before.
    $scraper_stats = ScraperStat::where('scraper_id', $this->scraper->id)->first();

    // Next Pagination direction
    $direction = $this->scraper->direction == "1" ? 'forward' : 'backward';

    // Parse list page url.
    $next_page_num = $this->getPageNumFromPageListUrl($this->scraper->default_url);

    $list_page_url = $this->scraper->default_url;

    Log::info('===============================================================================================');
    Log::info('Starting scraper...');

    $can_scrape = true;
    if ($scraper_stats) {
      $can_scrape = false;
    }

    $debug_data = [];
    while(true) {
      if (!$can_scrape && $scraper_stats && $scraper_stats->list_page_url != $list_page_url) {
        // Get next page url.
        $next_page_num = $direction == 'forward' ? $next_page_num + 1 : $next_page_num - 1;
        if ($next_page_num == -1)
          break;

        // generate next page url
        $list_page_url = $this->getNextListPageUrl($list_page_url, $next_page_num);
        if (!$list_page_url)
          break;

        $this->scraper_status['list_page'] = $list_page_url;
        $this->scraper_status['detail_page'] = '';

        continue;
      }

      if ($scraper_stats && $scraper_stats->list_page_url == $list_page_url && $scraper_stats->item_url == '') {
        $can_scrape = true;
      }

      // Step 1 : Scrape List Page
      Log::info('_______________________________________________________________________');
      Log::info('Scraping list page... (' . $list_page_url . ')');
      $links = $this->scrapeListPage($list_page_url);

      // Wait for some seconds.
      $delay = mt_rand($this->settings['delay_min'], $this->settings['delay_max']);
      sleep($delay);

      // Step 2 : Scrape Item Page
      if (!empty($links)) {
        foreach($links as $page_url) {
          if (!$can_scrape && $scraper_stats && $scraper_stats->item_url != $page_url) {
            continue;
          }

          $can_scrape = true;

          // Check whether current scraper should be paused.
          $this->scraper_status['detail_page'] = $page_url;
          if ($this->check_scraper_status())
            return;

          $scraped_data = $this->scrapeDetailPage($page_url);
          $debug_data[] = [
            'list_url' => $list_page_url,
            'url' => $page_url,
            'data' => $scraped_data
          ];

          // Wait for some seconds.
          $delay = mt_rand($this->settings['delay_min'], $this->settings['delay_max']);
          sleep($delay);
        }

      } else {
        Log::notice("Haven't found any detail page info from " . $list_page_url . ".");
        Log::notice("Continue to the next page...");
        break;
      }

      // Step 3 : Get next page url.
      $next_page_num = $direction == 'forward' ? $next_page_num + 1 : $next_page_num - 1;
      // Log::debug('Next page num: ' . $next_page_num);
      if ($next_page_num == -1)
        break;

      // generate next page url
      $list_page_url = $this->getNextListPageUrl($list_page_url, $next_page_num);
      // Log::debug('Next page url: ' . $list_page_url);
      if (!$list_page_url)
        break;

      $this->scraper_status['list_page'] = $list_page_url;
      $this->scraper_status['detail_page'] = '';

      // Check whether current scraper should be paused.
      if ($this->check_scraper_status())
        return;

      // Log::notice("Continue to the next page...");
    }

    // Mark current scraper as completed.
    $scraper_info = Scraper::find($this->scraper->id);
    if ( $scraper_info ) {
      $scraper_info->update(['status' => 'stopped']);
    }

    // Delete scraper status info from stats table
    ScraperStat::where('scraper_id', $this->scraper->id)->delete();

    return $debug_data;
  }

  public function retry($log_item) {
    Log::info('Prepare to retry failed scraper... (' . $log_item->url . ')');

    // Validation (Non completed settings)
    /*if (!isset($this->settings['scraper_ip_ports']) || count($this->settings['scraper_ip_ports']) == 0) {
      // This time, no need to log again. Just return.
      return;
    }*/

    $debug_data = [];

    // First, check if current page is list page.
    $pagenum = $this->getPageNumFromPageListUrl($log_item->url);
    if ($pagenum) {
      ScraperLog::where('id', $log_item->id)->delete(); // Delete log item

      // Log::info('The page is list page. Prepare to re-scrape list page...');

      // Next Pagination direction
      $direction = $this->scraper->direction == "1" ? 'forward' : 'backward';

      // Parse list page url.
      $next_page_num = $this->getPageNumFromPageListUrl($log_item->url);

      $list_page_url = $log_item->url;

      // Log::info('Starting scraper...');

      while(true) {
        // Check whether to stop rescrape.
        if ($this->check_rescraper_status())
          return;

        // Step 1 : Scrape List Page
        Log::info('Scraping list page... (' . $list_page_url . ')');
        $links = $this->scrapeListPage($list_page_url);

        // Wait for some seconds.
        $delay = mt_rand($this->settings['delay_min'], $this->settings['delay_max']);
        sleep($delay);

        // Step 2 : Scrape Item Page
        if (!empty($links)) {
          foreach($links as $page_url) {
            // Check whether to stop rescrape.
            if ($this->check_rescraper_status())
              return;

            $scraped_data = $this->scrapeDetailPage($page_url);
            $debug_data[] = [
              'list_url' => $list_page_url,
              'url' => $page_url,
              'data' => $scraped_data
            ];

            // Wait for some seconds.
            $delay = mt_rand($this->settings['delay_min'], $this->settings['delay_max']);
            sleep($delay);
          }
        } else {
          Log::notice("Haven't found any detail page info from " . $list_page_url . ".");
          Log::notice("Continue to the next page...");
          break;
        }

        // Step 3 : Get next page url.
        $next_page_num = $direction == 'forward' ? $next_page_num + 1 : $next_page_num - 1;
        // Log::debug('Next page num: ' . $next_page_num);
        if ($next_page_num == -1)
          break;

        // generate next page url
        $list_page_url = $this->getNextListPageUrl($list_page_url, $next_page_num);
        // Log::debug('Next page url: ' . $list_page_url);
        if (!$list_page_url)
          break;

        // Log::notice("Continue to the next page...");
      }
    } else {
      // Check whether to stop rescrape.
      if ($this->check_rescraper_status())
        return;

      // Log::info('The page is detail page. Prepare to re-scrape list page...');

      $scraped_data = $this->scrapeDetailPage($log_item->url);
      ScraperLog::where('id', $log_item->id)->delete(); // Delete log item

      $debug_data[] = [
        'url' => $log_item->url,
        'data' => $scraped_data
      ];
    }

    return $debug_data;
  }

  public function scrapeListPage($url) {
    $config = [
      'timeout' => 60,
    ];
    if (count($this->proxies) > 0) {
      // 'proxy' => 'http://cohfzrzw:nu2y6q8h5v7m@209.127.191.180:9279' // Proxy Authentication: username and password
      $config['proxy'] = $this->proxies[mt_rand(0, count($this->proxies) - 1)]; // Proxy Authentication: IP Authorization
    }

    $client = new Client(HttpClient::Create($config));

    $crawler = $client->request('GET', $url);

    $this->logger->setUrl($url);
    if (!$crawler)
      $this->logger->update_log_param('scrape', 0);

    $page_links = [];

    try {
      $page_links = $crawler->filter($this->scraper->item_url)->each(function($node) use( $url ) {
        // Check if url contains domain
        $href = $node->attr('href');
        if (substr($href, 0, 4) != 'http') {
          $href = $this->relativeToAbsoluteUrl($href, $url);
        }
        return $href;
      });
    } catch (\Exception $e) {
      $page_links = [];
    }

    if (count($page_links) == 0)
      $this->logger->update_log_param('detail_url', 0);
    $this->logger->save_log();

    return $page_links;
  }

  public function scrapeDetailPage($url) {
    $config = [
      'timeout' => 60,
    ];
    if (count($this->proxies) > 0) {
      // 'proxy' => 'http://cohfzrzw:nu2y6q8h5v7m@209.127.191.180:9279' // Proxy Authentication: username and password
      $config['proxy'] = $this->proxies[mt_rand(0, count($this->proxies) - 1)]; // Proxy Authentication: IP Authorization
    }

    $client = new Client(HttpClient::Create($config));

    $crawler = $client->request('GET', $url);

    $this->logger->setUrl($url);
    if (!$crawler)
      $this->logger->update_log_param('scrape', 0);

    Log::info('Scraping item detail page... (' . $url . ')');

    $webp_compress_quality = 100;

    $scrape_status = true;

    $titles = $this->filterItemInfo($crawler, $this->scraper->title, 'content');
    if (count($titles) > 0) {
      // Log::info('Scrape "Title" >>> Success!');
    } else {
      // Log::error('Scrape "Title" >>> Not Found!');
      $scrape_status = false;
      $this->logger->update_log_param('title', 0);
    }

    $images = $this->filterItemInfo($crawler, $this->scraper->image, 'src', $url);
    // if (count($images) > 0) {
    //   Log::info('Scrape "Images" >>> Success!');
    // } else {
    //   Log::error('Scrape "Images" >>> Not Found!');
    // }

    $videos = $this->filterItemInfo($crawler, $this->scraper->video, 'src', $url);
    // if (count($videos) > 0) {
    //   Log::info('Scrape "Videos" >>> Success!');
    // } else {
    //   Log::error('Scrape "Videos" >>> Not Found!');
    // }

    // log only when both images, videos were not scraped.
    if (count($images) == 0 && count($videos) == 0) {
      $scrape_status = false;
      $this->logger->update_log_param('media', 0);
    }

    // Get tags Info
    $artists = [];
    if (!empty($this->scraper->artist))
      $artists = $this->filterItemInfo($crawler, $this->scraper->artist, 'content');
    // if (count($artists) > 0) {
    //   Log::info('Scrape "Artists" >>> Success!');
    // } else {
    //   Log::error('Scrape "Artists" >>> Not Found!');
    //   // $this->logger->update_log_param('artists', 0);
    // }

    $origins = [];
    if (!empty($this->scraper->origins))
      $origins = $this->filterItemInfo($crawler, $this->scraper->origins, 'content');
    // if (count($origins) > 0) {
    //   Log::info('Scrape "Origins" >>> Success!');
    // } else {
    //   Log::error('Scrape "Origins" >>> Not Found!');
    //   // $this->logger->update_log_param('origins', 0);
    // }

    $characters = [];
    if (!empty($this->scraper->character))
      $characters = $this->filterItemInfo($crawler, $this->scraper->character, 'content');
    // if (count($characters) > 0) {
    //   Log::info('Scrape "Characters" >>> Success!');
    // } else {
    //   Log::error('Scrape "Characters" >>> Not Found!');
    //   // $this->logger->update_log_param('characters', 0);
    // }

    $medias = [];
    if (!empty($this->scraper->media))
      $medias = $this->filterItemInfo($crawler, $this->scraper->media, 'content');
    // if (count($medias) > 0) {
    //   Log::info('Scrape "Medias" >>> Success!');
    // } else {
    //   Log::error('Scrape "Medias" >>> Not Found!');
    //   // $this->logger->update_log_param('medias', 0);
    // }

    $misc = [];
    if (!empty($this->scraper->misc))
      $misc = $this->filterItemInfo($crawler, $this->scraper->misc, 'content');
    // if (count($misc) > 0) {
    //   Log::info('Scrape "Misc" >>> Success!');
    // } else {
    //   Log::error('Scrape "Misc" >>> Not Found!');
    //   // $this->logger->update_log_param('misc', 0);
    // }

    if (count($artists) == 0 && count($origins) == 0 && count($characters) == 0 && count($medias) == 0 && count($misc) == 0) {
      $scrape_status = false;
      $this->logger->update_log_param('tags', 0);
    }

    $tags = [
      'artists' => $artists,
      'origins' => $origins,
      'characters' => $characters,
      'medias' => $medias,
      'misc' => $misc
    ];

    if ($scrape_status === true) {
      // Now it's time to add post based on scraped data.
      // !!!!!!!!!!!!!!!!! Pre-condition !!!!!!!!!!!!!!!!!!!!
      // Choose only one file from image or video.
      // That is, will only download one file.
      // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

      // Step 1: Download image, video files and upload, generate thumbnail.
      $media_files = [];
      if (count($images) > 0) {
        foreach($images as $image) {
          $media_files[] = [
            'type' => 'image',
            'url' => $image
          ];
          break;
        }
      } else if (count($videos) > 0) {
        foreach($videos as $video) {
          $media_files[] = [
            'type' => 'video',
            'url' => $video
          ];
          break;
        }
      }

      // Log::debug('>>> Downloading files...');
        $path = '/public'.config('images.posts_storage_path');
        $path_video = '/public'.config('images.videos_storage_path');


      foreach($media_files as $media_info) {
          $url = $media_info['url'];
          $file_ext = Arr::last(explode('.', $url));

          // Change extension if we have some sh*t;
          switch($file_ext){
              // jpe fix;
              case 'jpe':
                  $file_ext = 'jpeg';
                  break;
              // For more fix add case here;
          }

          $thumbnail_medium_name = Str::random(27) . '.' . $file_ext;

          $original = '';
          $media_type = $media_info['type'];

          if($media_type == 'image'){
              $original = $path."/original/".$thumbnail_medium_name;
          }

          if($media_type == 'video'){
              $original = $path_video."/original/".$thumbnail_medium_name;
          }

          if($media_type == ''){
              Log::error('>>> Cant to detect media type.');
              Log::info('>>> Source File: ' . $url);
              $scrape_status = false;
              $this->logger->update_log_param('download', 0);
              break;
          }


          Log::info('>>> Try to download media file <<<');
          Log::info('>>> Source File: '.$url);
          Log::info('>>> Destination File: ' . $original);

          $media_path = storage_path() . "/app";
          $media = [
              'original', 'medium', 'thumbnail'
          ];
          foreach($media as $key => $type){
              File::ensureDirectoryExists($media_path . $path.'/'.$type);
              File::ensureDirectoryExists($media_path . $path_video.'/'.$type);
              $media[$type] = config("images.$type");
              unset($media[$key]);
          }
          unset($media['original']);

          $download_size = $this->chunked_copy($url, storage_path() . "/app".$original);
          if (!$download_size) {
              Log::error('>>> BAD DOWNLOAD SIZE <<<');

              // Log error
              $scrape_status = false;
              $this->logger->update_log_param('download', 0);
              break;
          }

          $mime_type = '';
          if($media_type == 'image'){
              $mime_type = Storage::mimeType($path."/original/".$thumbnail_medium_name);
          }

          if($media_type == 'video'){
              $mime_type = Storage::mimeType($path_video."/original/".$thumbnail_medium_name);
          }

          if($mime_type == ''){
              Log::error('>>> Cant to detect mime type.');
              Log::info('>>> Source File: ' . $url);
              $scrape_status = false;
              $this->logger->update_log_param('download', 0);
              break;
          }

          Log::debug('>>> Mime Type: ' . $mime_type);

        // Check downloaded file;
          if(!file_exists(storage_path() . "/app/".$original)){
              Log::error('>>> FAILED FILE DOWNLOAD <<<');
              continue;
          }


        if ($media_type === 'image') {
          // Log::debug('>>> Generating Thumbnail Image...');
          try {
              foreach($media as $type_name => $type){
                  /* Gif and Images */
                  if ($mime_type == 'image/gif') {
                      /* GIF */
                      $thumbnail_medium = new Imagick($media_path.'/'.$original);
                      $thumbnail_medium = $thumbnail_medium->coalesceImages();
                      do {
                          $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                      } while ( $thumbnail_medium->nextImage());

                      $thumbnail_medium = $thumbnail_medium->deconstructImages();

                      $thumbnail_medium->writeImages($media_path . "$path/$type_name/" . $thumbnail_medium_name, true);
                  }   else{
                      /* Other Image types */

                      // Turn off memory limits;
                      ini_set('memory_limit', '-1');

                      $source = Storage::get($path."/original/".$thumbnail_medium_name);

                      $thumbnail_medium = \Intervention\Image\Facades\Image::make($source);
                      $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                          $constraint->aspectRatio();
                      });


                      $thumbnail_medium->save($media_path . "$path/$type_name/" . $thumbnail_medium_name);
                  }

                  $media[$type_name]['path'] =  "$path/$type_name/" . $thumbnail_medium_name;
              }

              $media['original']['path'] = $original;
            // Log::debug('>>> Thumbnail Image is generated: ' . $thumbnail_medium_name);
          } catch (ImagickException $e) {
            Log::error('>>> Exception occured while generating Thumbnail.');
            Log::info('>>> Source File: ' . $url);
            Log::info('>>> Destination File: ' . $original);
            Log::info('>>> Downloaded Size: ' . $download_size);
            $scrape_status = false;
          } catch (Exception $e) {
            Log::error('>>> Exception occured while generating Thumbnail.');
            Log::info('>>> Source File: ' . $url);
            Log::info('>>> Destination File: ' . $original);
            Log::info('>>> Downloaded Size: ' . $download_size);
            $scrape_status = false;
          }
        }

        if ($media_type === 'video') {
            $ffprobe = FFProbe::create();
            $video_stream = $ffprobe
                ->streams(storage_path() . "/app".$path_video."/original/" . $thumbnail_medium_name)
                ->videos()
                ->first();

            /* At first, we need to compress video */
            // Get current video size;
            $video_dimensions = $video_stream->getDimensions();
            $width = $video_dimensions->getWidth();
            $height = $video_dimensions->getHeight();

            // Compress video;
            $compress_array = [
                [
                    'path' => 'original',
                    'resolution' => 0
                ],
                [
                    'path' => 'thumbnail',
                    'resolution' => 480
                ],
                [
                    'path' => 'medium',
                    'resolution' => 720
                ],
            ];

            $image_file_name = str_replace('.'.$file_ext, '', $thumbnail_medium_name).'.jpg';

            foreach($compress_array as $compress){
                Log::info('>>> Saving video for '.$compress['path']);

                if($height < $width){
                    // For Landscape view;
                    $m_video_width = $compress['path'] == 'original' ? $width : $compress['resolution'];
                    $m_video_height = ceil($height * ($compress['path'] == 'original' ? $width : $compress['resolution']/$width));
                    if($m_video_height % 2 == 1) $m_video_height++;
                }   else{
                    // For Portrait view;
                    $m_video_height = $compress['path'] == 'original' ? $height : $compress['resolution'];
                    $m_video_width = ceil($width * ($compress['path'] == 'original' ? $height : $compress['resolution']/$height));
                    if($m_video_width % 2 == 1) $m_video_width++;
                }

                // Resize video
                $ffmpeg = FFMpeg::create();
                $m_video = $ffmpeg->open(storage_path() . "/app".$path_video."/original/" . $thumbnail_medium_name);
                $m_video
                    ->filters()
                    ->resize(new Dimension($m_video_width, $m_video_height))
                    ->synchronize();

                switch($file_ext){
                    case 'ogg':
                        $format = new Ogg();
                        break;
                    case 'webm':
                        $format = new WebM();
                        break;
                    case 'wmv':
                        $format = new WMV();
                        break;
                    case 'wmv3':
                        $format = new WMV3();
                        break;
                    default:
                        $format = new X264();

                }

                $format
                    ->setKiloBitrate(704)
                    ->setAudioChannels(2)
                    ->setAudioKiloBitrate(256);

                if($compress['path'] != 'original'){
                    $m_video->save($format, storage_path() . "/app".$path_video."/".$compress['path']."/" . $thumbnail_medium_name);
                }

                /* Make preview images for post */
                // Getting video duration;
                $duration = $video_stream->get('duration');

                Log::info('>>> Video duration '.$duration.' sec.');

                // If video longer than 1 second;
                if($duration > 1){
                    $time_to_image = 1;
                }  else{
                    // If video shorter than 1 seconds, than we set tts like current duration - 0.1;
                    $time_to_image = $duration - 0.1;
                }

                $source = storage_path() . "/app".$path."/".$compress['path']."/" . $image_file_name;
                Log::info('>>> Trying to save image: '.$source);
                $m_video
                    ->frame(Coordinate\TimeCode::fromSeconds($time_to_image))
                    ->save($source);
                Log::info('>>> Image successfully saved.');

                // Resize preview;
                $thumbnail_medium = \Intervention\Image\Facades\Image::make($source);
                $thumbnail_medium->resize($m_video_width, $m_video_height, function($constraint){
                    $constraint->aspectRatio();
                });

                $thumbnail_medium->save($source);
            }

            // Add images paths in response;
            $path_array = ['original', 'medium', 'thumbnail'];
            foreach($path_array as $path_item){
                $media[$path_item]['path'] =  "/$path_item/" . $image_file_name;
                $media['video_'.$path_item]['path'] =  "/$path_item/" . $thumbnail_medium_name;
            }
        }

          // Clean response array;
          foreach($media as $key => $item){
              $media[$key] = str_replace($path, '', $item['path']);
              if(isset($media[$key]['width'])){
                  unset($media[$key]['width']);
              }

              if(isset($media[$key]['height'])){
                  unset($media[$key]['height']);
              }
          }
      }

      // Download & Upload media files completed. Now it's time to add post.
      if ($scrape_status) {
        // Step 2: Prepare data for post.
        $title = $titles[0];

        // Generate slug
          $title = strip_tags($title);
          $slug = Str::slug($title, '-');
          $post_with_same_slug = Post::where('slug', 'like', $slug . '%')->get();

          if (count($post_with_same_slug) > 0) {
              $slug = Post::getNewSlug($slug, $post_with_same_slug);
          }

        $post_data = [
          'user_id' => $this->scraper->user_id,
          'title' => $title,
          'slug' => $slug,
          'description' => '{"time": '.time().',"blocks":[]}',
          'video' => $media_type == 'video' ? [
              'original' => $media['video_original'],
              'medium' => $media['video_medium'],
              'thumbnail' => $media['video_thumbnail']
          ] : [],
          'original' => $media['original'],
          'thumbnail' => $media['thumbnail'],
          'medium' => $media['medium'],
          'post_type' => $media_type == 'video' ? 'video' : 'image',
          'status' => 'draft',
          'tags' => $tags
        ];

        // Step 3: Save Post.
        if (!$this->add_post($post_data)) {
          Log::error('>>> Failed to add post!');
          // Log error
          $this->logger->update_log_param('save', 0);
        }
      }
    }
    $this->logger->save_log();

    return compact('titles', 'images', 'videos', 'tags');
  }

  public function filterItemInfo($crawler, $filter_key, $filter_attr, $url = '') {
    $new_filter_key = $filter_key;

    // Check $filter_key
    $f_letter = substr($filter_key, 0, 1);
    if ($f_letter == '<') {
      // Filter by tag name
      $new_filter_key = substr($new_filter_key, 1, strlen($new_filter_key) - 2); // Remove first and last letter.
    } else if (in_array($f_letter, ['.', '#'])) {
      // Filter by Query Selector, so no need to change.
      $new_filter_key = $new_filter_key;
    } else if (strpos($new_filter_key, '"') !== false || strpos($new_filter_key, "'") !== false) {
      // Filter by attribute. For example input[name="usernmae"]
      if ($f_letter != '[' && strpos($new_filter_key, '[') === false) {
        // Add additional square bracket for proper query select filtering, only when square bracket isn't added to filter key yet.
        $new_filter_key = '[' . $new_filter_key . ']';
      }
    } else {
      // Filter by item content text.
      $new_filter_key = sprintf(":contains('%s')", $new_filter_key);
    }

    $items_info = [];
    try {
      $items_info = $crawler->filter($new_filter_key)->each(function($node) use ($filter_attr, $url, $new_filter_key) {
        $ignore_node = false;
        if (strpos($new_filter_key, ':contains') !== false) {
          if ($node->children()->count() > 0) $ignore_node = true;
        }

        if (!$ignore_node) {
          switch ($filter_attr) {
            case 'src':
              if ($node->nodeName() == 'a') {
                $info = $node->attr('href');
              } else {
                $info = $node->attr('src');
              }
              if (substr($info, 0, 4) != 'http') {
                $info = $this->relativeToAbsoluteUrl($info, $url);
              }
              break;
            // case 'value':
            //   $info = $node->value();
            //   break;
            case 'content':
              $info = $node->text();
              break;
            default:
              $info = $node->attr($filter_attr);
          }
          return $info;
        }
      });
    } catch (\Exception $e) {
      $items_info = [];
    }

    return array_values( array_filter( $items_info ) );
  }

  public function getPageNumFromPageListUrl($url) {
    // Current acceptable pagination url are:
    // https://www.example.com/{page|pages|pg}/1/
    // https://www.example.com/?{page|pages|pg}=1
    $url_components = parse_url($url);

    if (isset($url_components['query'])) {
      parse_str($url_components['query'], $params);

      if (isset($params['page']) && !empty($params['page']))
        return intval($params['page']);
      if (isset($params['pages']) && !empty($params['pages']))
        return intval($params['pages']);
      if (isset($params['pg']) && !empty($params['pg']))
        return intval($params['pg']);
    } else {
      $url_parts = explode("/", $url);
      $pos = 0;
      foreach($url_parts as $index => $part) {
        if (in_array($part, ['page', 'pages', 'pg'])) {
          $pos = $index;
          break;
        }
      }

      if (count($url_parts) > $pos + 1) {
        return intval($url_parts[$pos + 1]);
      }
    }

    return false;
  }

  public function getNextListPageUrl($old_url, $pagenum) {
    // Current acceptable pagination url are:
    // https://www.example.com/{page|pages|pg}/1/
    // https://www.example.com/?{page|pages|pg}=1
    $url_components = parse_url($old_url);

    if (isset($url_components['query'])) {
      parse_str($url_components['query'], $params);

      if (isset($params['page']) || isset($params['pages']) || isset($params['pg'])) {
        if (isset($params['page']) && !empty($params['page']))
          $params['page'] = $pagenum;
        if (isset($params['pages']) && !empty($params['pages']))
          $params['pages'] = $pagenum;
        if (isset($params['pg']) && !empty($params['pg']))
          $params['pg'] = $pagenum;

        $url_components['query'] = http_build_query($params);

        $url = $this->unparse_url($url_components);
        return $url;
      } else {
        return false;
      }
    }

    $url_parts = explode("/", $old_url);
    $pos = 0;
    foreach($url_parts as $index => $part) {
      if (in_array($part, ['page', 'pages', 'pg'])) {
        $pos = $index;
        break;
      }
    }

    if (count($url_parts) > $pos + 1) {
      $url_parts[$pos + 1] = $pagenum;
    } else {
      return false;
    }

    $url = implode("/", $url_parts);
    return $url;
  }

  public function relativeToAbsoluteUrl($inurl, $absolute) {
    // Get all parts so not getting them multiple times.
    $absolute_parts = parse_url($absolute);

    // Test if URL is already absolute (contains host, or begins with '/')
    if (strpos($inurl, $absolute_parts['host']) == false) {
      // Define $tmpurlprefix to prevent errors below
      $tmpurlprefix = "";

      // Formulate URL prefix (SCHEME)
      if (!empty($absolute_parts['scheme'])) {
        // Add scheme to tmpurlprefix
        $tmpurlprefix .= $absolute_parts['scheme'] . "://";
      }

      // Formulate URL prefix (USER, PASS) (Not required in our case actually)
      if (!empty($absolute_parts['user']) && !empty($absolute_parts['pass'])) {
        // Add user:pass to tmpurlprefix
        $tmpurlprefix .= $absolute_parts['user'] . ":" . $absolute_parts['pass'] . "@";
      }

      // Formulate URL prefix (HOST, PORT)
      if (!empty($absolute_parts['host'])) {
        // Add host to tmpurlprefix
        $tmpurlprefix .= $absolute_parts['host'];

        // Check for a port, add if exists
        if (!empty($absolute_parts['port'])) {
          // Add port to tmpurlprefix
          $tmpurlprefix .= ":" . $absolute_parts['port'];
        }
      }

      // Formulate URL prefix (PATH) and only add it if the path does not include ./
      if (!empty($absolute_parts['path']) && substr($inurl, 0, 1) != '/') {
        // Get path parts
        $path_parts = pathinfo($absolute_parts['path']);

        // Add path to tmpurlprefix
        $tmpurlprefix .= $path_parts['dirname'];
        $tmpurlprefix .= "/";

        if (empty($path_parts['extension'])) {
          $tmpurlprefix .= $path_parts['basename'];
          $tmpurlprefix .= "/";
        }

        // handle "../" URL prefix
        $tmpurl = $inurl;
        while(substr($tmpurl, 0, 3) == '../') {
          $tmpurlprefix = dirname($tmpurlprefix);
          $tmpurlprefix .= "/";
          $tmpurl = substr($tmpurl, 3);
        }

      } else {
        $tmpurlprefix .= "/";
      }

      // Time to remove '/'
      if (substr($inurl, 0, 1) == '/') {
        $inurl = substr($inurl, 1);
      }

      // Time to remove './'
      if (substr($inurl, 0, 2) == './') {
        $inurl = substr($inurl, 2);
      }

      // Time to remove './'
      while (substr($inurl, 0, 3) == '../') {
        $inurl = substr($inurl, 3);
      }

      return $tmpurlprefix . $inurl;
    } else {
      // Path is already absolute.
      return $inurl;
    }
  }

  public function unparse_url($parsed_url) {
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
    $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
    $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
    $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
    $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
    $pass     = ($user || $pass) ? "$pass@" : '';
    $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
    $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
    $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
    return "$scheme$user$pass$host$port$path$query$fragment";
  }

  /**
   * Chunked copy large files.
   * Copy from source to destination by 1 mb at a time until copy 1 GB.
   * Once copy 1 GB, close file and reopen to append.
   */
  public function chunked_copy($source_url, $destination) {
    // Fix URLs with Japanese symbols;
      $change = true;
      while($change){
          preg_match('/[\p{Katakana}\p{Hiragana}\p{Han}]+/u', $source_url, $matches, PREG_OFFSET_CAPTURE);

          if(count($matches) > 0){
              $match = $matches[0][0];

              $part_1 = substr($source_url, 0, $matches[0][1]);
              $part_2 = substr($source_url, $matches[0][1] + strlen($match), strlen($source_url));
              $source_url = $part_1.urlencode($match).$part_2;
          }   else{
              $change = false;
          }
      }

    // No time limits for loading real big files;
    set_time_limit(-1);

    // 1 mega byte at a time.
    $buffer_size = 1048576;

    # 1 GB write-chunks.
    $write_chunks = 1073741824;

    $ret = 0;
    $fin = fopen($source_url, "rb");
    if (!$fin) return false;

    $fout = fopen($destination, "w");
    if (!$fout) return false;

    $bytes_written = 0;
    while(!feof($fin)) {
      $bytes = fwrite($fout, fread($fin, $buffer_size));
      $ret += $bytes;
      $bytes_written += $bytes;
      if ($bytes_written >= $write_chunks) {
        // (another) chunk of 1GB has been written, close and reopen the stream
        fclose($fout);
        $fout = fopen($destination, "a"); // "a" for "append";
        if (!$fout) return false;
        $bytes_written = 0; // re-start counting
      }
    }
    fclose($fin);
    fclose($fout);
    return $ret; // return number of bytes written
  }

  public function add_post($post_data) {
      $post = new Post();
      $post->title = $post_data['title'];
      $post->slug = $post_data['slug'];
      $post->body = $post_data['description'];
      $post->excerpt = $post_data['description'];
      $post->user_id = $post_data['user_id'];
      $post->type = $post_data['post_type'];
      $post->original = $post_data['original'];
      $post->medium = $post_data['medium'];
      $post->thumbnail = $post_data['thumbnail'];
      $post->category_id = 1;
      $post->status = 'draft';
      $post->save();

    if ( !empty($post_data['video']) ) {
        DB::table('posts_videos')
            ->insert([
                'post_id' => $post->id,
                'original' => $post_data['video']['original'],
                'medium' => $post_data['video']['medium'],
                'thumbnail' => $post_data['video']['thumbnail'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }

    $tag_categories = TagsCategories::whereIn('name', ['origins', 'media', 'characters', 'artists', 'misc'])->get();
    foreach ($tag_categories as $tag_category) {
      switch (strtolower($tag_category->name)) {
        case 'origins':
          $tags_input = $post_data['tags']['origins'];
          break;
        case 'media':
          $tags_input = $post_data['tags']['medias'];
          break;
        case 'characters':
          $tags_input = $post_data['tags']['characters'];
          break;
        case 'artists':
          $tags_input = $post_data['tags']['artists'];
          break;
        case 'misc':
          $tags_input = $post_data['tags']['misc'];
          break;
        default:
          $tags_input = [];
      }

      if (count($tags_input) > 0) {
        foreach ($tags_input as $tag_input) {
          $tag = Tag::where('name', $tag_input)
              ->where('category_id', $tag_category->id)
              ->first();

          // If tag doesn't exist yet, create it
          if (!$tag) {
            $tag = new Tag();
            $tag->name = $tag_input;
            $tag->category_id = $tag_category->id;
            $tag->body = '{"time": '.time().',"blocks":[]}';
            $tag->save();
          }

          // Insert posts_tag
            DB::table('post_tag')
                ->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag->id,
                    'created_at' => now(),
                    'updated_at'=> now()
                ]);
        }
      }
    }
    return true;
  }

  public function check_scraper_status() {
    // Check current scraper status.
    $scraper_info = Scraper::find($this->scraper->id);

    // Save current status.
    ScraperStat::where('scraper_id', $this->scraper->id)
        ->update([
            'list_page_url' => $this->scraper_status['list_page'],
            'item_url' => $this->scraper_status['detail_page']
        ]);

    return $scraper_info->status == 'paused' || $scraper_info->status == 'stopped';
  }

  public function check_rescraper_status() {
    return $this->status == 'stopped';
  }
}
