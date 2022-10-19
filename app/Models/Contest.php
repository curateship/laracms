<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $medium
 * @property mixed $thumbnail
 * @property mixed $body
 * @property mixed $user_id
 */
class Contest extends Model
{
    use HasFactory;

    public function removeTagImages($type){
        $path = '/public'.config('images.contest_storage_path');

        switch($type){
            // Main;
            case 'main':
                Storage::delete($path.$this->original['original']);
                Storage::delete($path.$this->medium);
                Storage::delete($path.$this->thumbnail);
                break;

            // In body images;
            case 'body':
                $body_array = json_decode($this->body, true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $file_name = Arr::last($url_array);

                        Storage::delete($path.'/original/'.$file_name);
                        Storage::delete($path.'/medium/'.$file_name);
                        Storage::delete($path.'/thumbnail/'.$file_name);
                    }
                }
                break;
        }
    }

    public function getContent(){
        $content = Post::jsonToHtml($this->body, 'page');

        return html_entity_decode($content);
    }

    public static function checkExitRoute($route_for_checking){
        $routes = Route::getRoutes();

        foreach($routes as $route){
            $url = $route->uri();

            if(strpos($url, $route_for_checking) !== false && strpos($url, $route_for_checking) == 0){
                return false;
            }
        }

        return true;
    }

    public static function getCounters(){
        $counters = static::groupBy('status')
            ->selectRaw('status, count(*) as value');

        $counters = $counters->get();

        $result = [];
        $total = 0;
        foreach($counters as $counter){
            $result[$counter->status] = $counter->value;
            $total += $counter->value;
        }

        $counters_status_list = [
            'draft', 'published', 'open', 'close', 'total'
        ];


        foreach($counters_status_list as $status){
            if(!isset($result[$status])){
                $result[$status] = $status != 'total' ? 0 : $total;
            }
        }

        return $result;
    }

    public function author()
    {
        if($this->user_id == null){
            return null;
        }   else{
            return User::find($this->user_id);
        }
    }
}
