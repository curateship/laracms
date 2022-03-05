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
            $menu->add('Contact',     ['route'  => 'index',  'class' => 'header-v2__nav-item header-v2__nav-item--main header-v2__nav-link', 'id' => 'home']);
            $menu->add('About',     ['route'  => 'index',  'class' => 'header-v2__nav-item header-v2__nav-item--main header-v2__nav-link', 'id' => 'home']);
            $menu->add('About',     ['route'  => 'index',  'class' => 'header-v2__nav-item header-v2__nav-item--main header-v2__nav-link', 'id' => 'home']);
            $menu->add('About',     ['route'  => 'index',  'class' => 'header-v2__nav-item header-v2__nav-item--main header-v2__nav-link', 'id' => 'home']);
        });

        // Footer Navigation
        \Menu::make('footer', function ($menu) {
            $menu->add('Home',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Contact',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Term',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('About us',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
        });

        // Social Media
        \Menu::make('social', function ($menu) {
            $menu->add('Home',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Contact',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('Term',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
            $menu->add('About us',     ['route'  => 'index',  'class' => 'footer-v4__nav-item', 'id' => 'home']);
        });

        // User Dropdown Navigation
        \Menu::make('user-dropdown', function ($menu) {
            $menu->add('Dashboard',     ['route'  => 'index',  'class' => 'dropdown__item link-plain', 'id' => 'home']);
            $menu->add('Profile',     ['route'  => 'index',  'class' => 'dropdown__item', 'id' => 'home']);
            $menu->add('Edit Profile',     ['route'  => 'index',  'class' => 'dropdown__item link-plain', 'id' => 'home']);
        });
    
        return $next($request);
    }
}
