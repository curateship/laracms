<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

/**
 * @property mixed $status
 * @property mixed|string $slug
 * @property mixed $body
 * @property mixed $title
 */
class Page extends Model
{
    use HasFactory;

    public function getContent(){
        $content = Post::jsonToHtml($this->body);

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
}
