<?php

namespace App\Http\Controllers\Admin;

use Arr, Str, Image, File, Imagick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Services\ScraperService;
use App\Services\LoggerService;
use Illuminate\Support\Facades\Validator;

use App\Models\{Scraper, ScraperStat, ScraperLog, User};
//use Modules\Post\Entities\{ PostSetting, Post, PostsTag, PostsMeta };
//use Modules\Users\Entities\{User, Role};
//use Modules\Tag\Entities\{Tag, TagCategory};

class AdminScraperController extends Controller
{
  public function index() {
    $scrapers = Scraper::where('status', '!=', 'stopped')->get();
    if (!$scrapers) $scrapers = [];

    $scraper_ids = $this->getAllScraperIds();

      $re_scraper_status = 'stopped';
    foreach($scrapers as $scraper) {
      $scraper_url = isset($scraper->default_url) ? $scraper->default_url : '';
      if (!empty($scraper_url)) {
        $url = parse_url($scraper_url);
      }
      $scraper['domain'] = isset($url['host']) ? $url['host'] : '';

        // Get re-scraper status.
        $re_scraper_status = $scraper->status;
    }

    return view('admin.scraper.index', compact('scrapers', 'scraper_ids', 're_scraper_status'));
  }

  public function newScraper() {
    $scraper_ids = $this->getAllScraperIds();
    $users = $this->getScraperUsers();

    $action = 'add';

    $scraper_info = [];

    return view('admin::scraper.scraper-v1', compact('scraper_info', 'users', 'scraper_ids', 'action'));
  }

  public function loadScraper( $id ) {
    $scraper_ids = $this->getAllScraperIds();
    $users = $this->getScraperUsers();

    $action = 'update';
    $scraper_id = $id;

    $scraper_info = Scraper::find($id);
    if ( !$scraper_info ) $scraper_info = [];

    $scraper_url = isset($scraper_info->default_url) ? $scraper_info->default_url : '';
    if (!empty($scraper_url)) {
      $url = parse_url($scraper_url);
    }
    $scraper_domain = isset($url['host']) ? $url['host'] : '';

    return view('admin.scraper.scraper-v1', compact('scraper_info', 'users', 'scraper_ids', 'action', 'scraper_id', 'scraper_domain'));
  }

  public function saveScraper() {
    $validator = Validator::make(request()->all(), [
      'default_url' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
      'item_url' => 'required',
      'title' => 'required',
      'image' => 'required',
      'video' => 'required'
    ]);

    $alert = [
      'message' => 'A new scraper is added!',
      'class'   => 'alert--success',
    ];

    $scraper_id = request('scraper_id') ? request('scraper_id') : '';
    $action = request('action') ? request('action') : 'add';

    if ($validator->fails()) {
      $errors = [];
      foreach($validator->errors()->getMessages() as $error) {
        $errors[] = $error[0];
      }
      $alert['error'] = $errors;
      $alert['class'] = 'alert--error';
      return back()
        ->withInput()
        ->with('alert', $alert);
    }

    // Do Save action
    if (empty($scraper_id)) {
      // Add a new scraper
      $scraper = Scraper::create([
        'user_id'     => request('scraper_user'),
        'default_url' => request('default_url'),
        'direction'   => request('direction'),
        'item_url'    => request('item_url'),
        'title'       => request('title'),
        'image'       => request('image'),
        'video'       => request('video'),
        'artist'      => request('artist'),
        'origins'     => request('origins'),
        'character'   => request('character'),
        'media'       => request('media'),
        'misc'        => request('misc'),
        'status'      => 'stopped'
      ]);
    } else {
      // Update scraper
      $scraper = Scraper::find($scraper_id);
      if (!$scraper) {
        $alert['message'] = 'Scraper does not exists!';
        return back()
          ->withInput()
          ->with('alert', $alert);
      }

      $scraper->user_id = request('scraper_user');
      $scraper->default_url = request('default_url');
      $scraper->direction = request('direction');
      $scraper->item_url = request('item_url');
      $scraper->title = request('title');
      $scraper->image = request('image');
      $scraper->video = request('video');
      $scraper->artist = request('artist');
      $scraper->origins = request('origins');
      $scraper->character = request('character');
      $scraper->media = request('media');
      $scraper->misc = request('misc');
      $scraper->save();
    }

    if ($action == "update") {
      $alert['message'] = 'Scraper was updated!';
    }

    if ($action == 'scrape') {
      // Run scraper for current scraper.
      $scraper->status = 'ready';
      $scraper->save();

      // Add/Update scraper status info into stats table
      $scraper_stats = ScraperStat::where('scraper_id', $scraper->id)->first();
      if (!$scraper_stats) {
          $stat = new ScraperStat();
          $stat->scraper_id = $scraper->id;
          $stat->list_page_url = $scraper->default_url;
          $stat->item_url = '';
          $stat->save();
      }
    }

    if ($action == 'scrape') // Redirect to scraper list page.
      return redirect('scraper')->with('alert', $alert);
    else
      return redirect()->back()->with('alert', $alert);
  }

  public function runpauseScraperCron( $id ) {
    $scraper_info = Scraper::find($id);
    if ( !$scraper_info ) {
      return response()->json([
        'status' => false,
        'message' => 'Scraper does not exist!'
      ]);
    }

    $status = $scraper_info->status;
    $updated_status = $status == 'paused' ? 'ready' : 'paused';
    $scraper_info->update(['status' => $updated_status]);

    if ($updated_status == 'paused') {
      // Save current status into stats table.
      // Current list page and item index or page.
      // Do this action from scheduler? Or is it possible to get current status from scheduler here?
    }

    $success_message = $status == 'paused' ? 'Scraper is scheduled to run.' : 'Scraper is paused.';
    return response()->json([
      'status' => true,
      'message' => $success_message
    ]);
  }

  public function stopScraperCron( $id ) {
    $scraper_info = Scraper::find($id);
    if ( !$scraper_info ) {
      return response()->json([
        'status' => false,
        'message' => 'Scraper does not exist!'
      ]);
    }

    $scraper_info->status = 'stopped';
    $scraper_info->save();

    // Reset scraper status info from stats table
    ScraperStat::where('scraper_id', $id)->update([
      'list_page_url' => $scraper_info->default_url,
      'item_url' => ''
    ]);

    return response()->json([
      'status' => true,
      'message' => 'Scraper is stopped'
    ]);
  }

  public function deleteScraperCron( $id ) {
    $scraper_info = Scraper::find($id);
    if ( !$scraper_info ) {
      return response()->json([
        'status' => false,
        'message' => 'Scraper does not exist!'
      ]);
    }

    $scraper_info->delete();

    // Delete scraper status info from stats table
    ScraperStat::where('scraper_id', $id)->delete();

    return response()->json([
      'status' => true,
      'message' => 'Scraper is deleted.'
    ]);
  }

  public function getScraperUsers() {
    // Only Admin and Editor have authority to scrapers.
    $available_users = User::whereIn('role_user.role_id', [1, 2])
        ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
        ->select(['users.*', 'role_user.role_id'])
        ->get();

      $users = [
          'admin' => [],
          'editor' => []
      ];
    foreach($available_users as $user) {
      if ($user->role_id == 1)
        $users['admin'][] = $user;
      else
        $users['editor'][] = $user;
    }

    return $users;
  }

  public function getAllScraperIds() {
    $scrapers = Scraper::all();
    $ids = [];
    if ( $scrapers ) {
      foreach($scrapers as $scraper) {
        $ids[] = $scraper->id;
      }
    }
    return $ids;
  }

  public function retryScraper() {
    $re_scraper_settings = Settings::where('key', 'scraper_retry')->get()->first();
    if ($re_scraper_settings) {
      $status = $re_scraper_settings['value'];
      $updated_status = $status == 'stopped' ? 'ready' : 'stopped';

      $row = Settings::where('key', 'scraper_retry');
      $row->update(['value' => $updated_status]);
    } else {
      $updated_status = 'ready';
      $dateNow = now();
      $insert_data = array('key' => 'scraper_retry', 'value' => $updated_status, 'created_at' => $dateNow, 'updated_at' => $dateNow);
      Settings::insert($insert_data);
    }

    $success_message = $updated_status == 'stopped' ? 'Re-scraper is stopped.' : 'Re-scraper is scheduled to run.';
    return response()->json([
      'status' => true,
      'message' => $success_message
    ]);
  }

  public function getLogs(Request $request) {
    $time = !empty($request->input('time')) ? $request->input('time') : '';
    $logs = LoggerService::get_log();

    $ids = [];
    $log_ids = ScraperLog::select(['id'])->get();
    foreach($log_ids as $log_id) {
      $ids[] = $log_id->id;
    }

    $scraper_ids = [];
    $scrapers = Scraper::where('status', 'stopped')->get();
    foreach($scrapers as $scraper) {
      $scraper_ids[] = $scraper->id;
    }

    $logs_content = '';
    foreach($logs as $log){
        $logs_content .= view('admin.scraper.logs-item', [
            'scraper_url' => $log['scraper_url'],
            'messages' => $log['messages'],
            'log_id' => $log['id'],
            'page_url' => $log['scraper_url'],
            'scraper_id' => $log['scraper_id']
        ])->render();
    }

    return response()->json([
      'status' => true,
      'log_time' => date('Y-m-d H:i:s'), // Get current time
      'data' => $logs_content,
      'ids' => $ids,
      'scraper_ids' => $scraper_ids,
      'rescrape' => true//'ready' $re_scraper_settings && $re_scraper_settings['value'] == 'stopped' ? false : true
    ]);
  }

  public function deleteLogItem(Request $request) {
    if (empty($request->input('id'))) {
      return response()->json([
        'status' => false
      ]);
    }

    $id = $request->input('id');
    $log = ScraperLog::find($id)->delete();

    return response()->json([
      'status' => true
    ]);
  }

    public function scraperSetting() {
        $settings_data = Settings::getSiteSettings();

        // Scraper IP & Port info.
        if (isset($settings_data['scraper_ip_ports'])) {
            $scraper_ip_ports = unserialize($settings_data['scraper_ip_ports']);
        } else {
            $scraper_ip_ports = [];
        }

        // Scraper delay info.
        $delay_min = "";
        $delay_max = "";
        if (isset($settings_data['delay_min']))
            $delay_min = $settings_data['delay_min'];

        if (isset($settings_data['delay_max']))
            $delay_max = $settings_data['delay_max'];

        $scrapers = Scraper::all();
        $scraper_ids = [];
        foreach($scrapers as $scraper) {
            $scraper_ids[] = $scraper->id;
        }

        return view('admin::scraper.settings', compact('scraper_ip_ports', 'delay_min', 'delay_max', 'scraper_ids'));
    }
}
