<?php
namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Log;

use App\Models\{ScraperLog};

class LoggerService {
  private $scraper_id = 0;
  private $log_params = [
      'proxy' => '',
      'default_url' => '',
      'source_media' => '',
      'scrape' => '',
      'title' => '',
      // 'image' => '',
      // 'video' => '',
      'media' => '',
      'tags' => [],
      // 'artists' => '',
      // 'origins' => '',
      // 'characters' => '',
      // 'medias' => '',
      // 'misc' => '',
      'download' => '',
      'save' => '',
  ];
  private $page_url, $url;

  public function __construct($scraper_id) {
    $this->scraper_id = $scraper_id;
  }

  public function updateUrls($page_url, $url){
      $this->page_url = $page_url;
      $this->url = $url;
  }

  public function update_log_param($key, $value) {
    if (isset($this->log_params[$key]))
      $this->log_params[$key] = $value;

      $this->save_log();
  }

  public function save_log() {
      $page_url = $this->page_url;
      $item_url = $this->url;

      // Save this log into database.
      $param = [
          'scraper_id' => $this->scraper_id,
          'url' => $item_url,
          'page_url' => $page_url,
          'report' => json_encode($this->log_params)
      ];

      $log = ScraperLog::where('scraper_id', $param['scraper_id'])
          ->where('page_url', $param['page_url'])
          ->where('url', $param['url'])
          ->first();

      if($log == null){
          $log = new ScraperLog();
          $log->scraper_id = $param['scraper_id'];
          $log->page_url = $param['page_url'];
          $log->url = $param['url'];
      }

      $log->report = $param['report'];
      $log->save();
  }

  public static function get_log($date = '') {
      $logs = ScraperLog::select('scraper_logs.*')
          ->leftJoin('scrapers', 'scrapers.id', '=', 'scraper_logs.scraper_id')
          ->where('scrapers.status', 'running');

    if (!empty($date)) {
      // Make sure $time is valid timestamp value
      $time = date('Y-m-d H:i:s', strtotime($date));

      // Get all logs info after this time.
        $logs->where('scraper_logs.created_at', '>=', $time);
    }

      $logs = $logs->get();

    $log_data = [];
    foreach($logs as $log) {
      $log_messages = self::parse_log($log);

      if (!empty($log->url)) {
        $scraper_url = parse_url($log->url);
      }
      $scraper_domain = isset($scraper_url['host']) ? $scraper_url['host'] : '';

      if (count($log_messages['messages']) > 0) { // Just for exception handler
        $log_data[] = [
          'id' => $log->id,
          'scraper_id' => $log->scraper_id,
          'scraper_url' => $log->url,
          'page_url' => $log->page_url,
          'output_url' => $log_messages['output_url'],
          'domain' => $scraper_domain,
          'messages' => $log_messages['messages']
        ];
      }
    }

    return $log_data;
  }

  static function parse_log($log_info) {
    $messages = [];

    $output_url = true;

    if($log_info->report != ''){
        $log_report = json_decode($log_info->report, true);
    }   else{
        $log_report = [];
    }

    foreach($log_report as $key => $status) {
        if($status == '' || $status == []){
            continue;
        }

        if(!is_numeric($status)){
            $messages[] = [
                "message" => '<b>'.$key.'</b> - '.($key == 'tags' ? json_encode($status) : $status),
                "status" => 1
            ];

            continue;
        }

      switch ($key) {
        case 'proxy':
          if ($status == 0) {
            $messages[] = [
              "message" => "Cannot find <strong>IP:Port</strong> info. Scraper is canceled.",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'default_url':
          if ($status == 0) {
            $messages[] = [
              "message" => "Cannot find <strong>default list page url</strong>. Scraper is canceled.",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'scrape':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to scrape url: (" . $log_info->url . ")",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'detail_url':
          if ($status == 0) {
            $messages[] = [
              "message" => "Cannot find any detail page url from: (" . $log_info->url . ")",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'title':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to scrape <strong>title</strong>",
              "status" => 0
            ];
          }
          break;
        case 'media':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to scrape <strong>image/video</strong>",
              "status" => 0
            ];
          }
          break;
        // case 'image':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>image</strong>",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        // case 'video':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>video</strong>",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        case 'tags':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to scrape <strong>tags</strong>",
              "status" => 0
            ];
          }
          break;
        // case 'artists':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>Artists</strong> tags",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        // case 'origins':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>Origins</strong> tags",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        // case 'characters':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>Characters</strong> tags",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        // case 'medias':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>Medias</strong> tags",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        // case 'misc':
        //   if (!$status) {
        //     $messages[] = [
        //       "message" => "Failed to scrape <strong>Misc</strong> tags",
        //       "status" => 0
        //     ];
        //   }
        //   break;
        case 'download':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to download <strong>image/video</strong> files.",
              "status" => 0
            ];
          }
          break;
        case 'save':
          if ($status == 0) {
            $messages[] = [
              "message" => "Failed to add a new post with scraped data.",
              "status" => 0
            ];
          }
          break;
      }
    }

    return [
      'output_url' => $output_url,
      'messages' => $messages
    ];
  }
}
