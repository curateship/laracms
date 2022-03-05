<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    public function handle($request, Closure $next)
    {
        // Header Menu
        \Menu::make('header', function ($menu) {

            // Link1
            $about = $menu->add('About',    ['route'  => 'index', 'class' => 'header-v2__nav-item header-v2__nav-item--main']);
            $about->link->attr(['class' => 'header-v2__nav-link', 'data-toggle' => 'dropdown']);
            
            // Link2
            $about = $menu->add('About',    ['route'  => 'index', 'class' => 'header-v2__nav-item header-v2__nav-item--main']);
            $about->link->attr(['class' => 'header-v2__nav-link', 'data-toggle' => 'dropdown']);
          
        });

        // User Dropdown Navigation
        \Menu::make('user-dropdown', function ($menu) {
            
            // Dashboard
            $menu = $menu->add('Dashboard',    ['route'  => 'index']);
            $menu->link->attr(['class' => 'dropdown__item']);

            // Profile
            $menu = $menu->add('Profile',    ['route'  => 'index']);
            $menu->link->attr(['class' => 'dropdown__item']);

            // Edit Profile
            $menu = $menu->add('Edit Profile',    ['route'  => 'index']);
            $menu->link->attr(['class' => 'dropdown__item']);
            
            // Divider
            $menu->divide( ['class' => 'border-top border-contrast-lower margin-top-xs margin-bottom-xs'] );            
        });
    
        // Footer Navigation
        \Menu::make('footer', function ($menu) {
            $menu->add('Home',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Contact',     ['route'  => 'login',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Term',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('About us',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
        });

        // Social Media
        \Menu::make('social', function ($menu) {
 
        });

        return $next($request);
    }
}
