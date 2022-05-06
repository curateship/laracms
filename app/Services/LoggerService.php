<?php
namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Log;

use App\Models\{ScraperLog};

class LoggerService {
  private $scraper_id = 0;
  private $scraper_url = '';
  private $log_params = [];

  public function __construct($scraper_id) {
    $this->scraper_id = $scraper_id;
    $this->init_log_params();
  }

  public function setUrl($url) {
    $this->scraper_url = $url;
  }

  public function init_log_params() {
    $this->log_params = [
      'proxy' => '',
      'default_url' => '',
      'scrape' => '',
      'detail_url' => '',
      'title' => '',
      // 'image' => '',
      // 'video' => '',
      'media' => '',
      'tags' => '',
      // 'artists' => '',
      // 'origins' => '',
      // 'characters' => '',
      // 'medias' => '',
      // 'misc' => '',
      'download' => '',
      'save' => '',
    ];
  }

  public function update_log_param($key, $value) {
    if (isset($this->log_params[$key]))
      $this->log_params[$key] = $value;
  }

  public function save_log($include_url = true) {
    // Remove any item hasn't set yet, that is, remove all item have null value.
    $this->log_params = array_filter($this->log_params, function($v) {
      return $v !== '';
    });

    // Save this log into database.
    if (count($this->log_params) > 0) {
      $param = [
        'scraper_id' => $this->scraper_id,
        'url' => '',
        'report' => serialize($this->log_params)
      ];


      if ($include_url) {
        $param['url'] = $this->scraper_url;
      }

      ScraperLog::updateOrCreate($param);
    }

    // After save log data, reset log params.
    $this->init_log_params();
  }

  public static function get_log($date) {
    if (!empty($date)) {
      // Make sure $time is valid timestamp value
      $time = date('Y-m-d H:i:s', strtotime($date));

      // Get all logs info after this time.
      $logs = ScraperLog::where('created_at', '>=', $time)->get();
    } else {
      $logs = ScraperLog::all();
    }

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

    $log_report = unserialize($log_info->report);
    foreach($log_report as $key => $status) {
      switch ($key) {
        case 'proxy':
          if (!$status) {
            $messages[] = [
              "message" => "Cannot find <strong>IP:Port</strong> info. Scraper is canceled.",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'default_url':
          if (!$status) {
            $messages[] = [
              "message" => "Cannot find <strong>default list page url</strong>. Scraper is canceled.",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'scrape':
          if (!$status) {
            $messages[] = [
              "message" => "Failed to scrape url: (" . $log_info->url . ")",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'detail_url':
          if (!$status) {
            $messages[] = [
              "message" => "Cannot find any detail page url from: (" . $log_info->url . ")",
              "status" => 0
            ];
            $output_url = false;
          }
          break;
        case 'title':
          if (!$status) {
            $messages[] = [
              "message" => "Failed to scrape <strong>title</strong>",
              "status" => 0
            ];
          }
          break;
        case 'media':
          if (!$status) {
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
          if (!$status) {
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
          if (!$status) {
            $messages[] = [
              "message" => "Failed to download <strong>image/video</strong> files.",
              "status" => 0
            ];
          }
          break;
        case 'save':
          if (!$status) {
            $messages[] = [
              "message" => "Failed to add a new post with scraped data.",
              "status" => 0
            ];
          }
          break;
        default:
      }
    }
    return [
      'output_url' => $output_url,
      'messages' => $messages
    ];
  }
}
