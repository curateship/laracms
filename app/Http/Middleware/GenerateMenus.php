<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateMenus
{
    public function handle($request, Closure $next)
    {
        // Header Menu
        \Menu::make('header', function ($menu) {

            // Link1
            $menu->add('About 1', ['route'  => 'index'])->id('about1');
            // Adding sub items;
            $menu->add('Sub about 1', ['parent' => 'about1', 'url' => 'Link address']);
            $menu->add('Sub about 2', ['parent' => 'about1', 'url' => 'Link address']);
            $menu->add('Sub about 3', ['parent' => 'about1', 'url' => 'Link address']);
            // Link2
            $menu->add('About 2', ['route'  => 'index']);
            // Link3
            $menu->add('About 3', ['route'  => 'index']);
        });

        // Links Sidebar
            \Menu::make('link-exchange', function ($menu) {
           // Link 1
           $menu = $menu->add('Hentai Haven',    ['url'  => 'https://google.com']);
           $menu->link->attr(['class' => 'link-plain text-sm color-contrast-medium']);
           // Link 2
           $menu = $menu->add('Hentai School',    ['url'  => 'https://google.com']);
           $menu->link->attr(['class' => 'link-plain text-sm color-contrast-medium']);
        });

        // User Dropdown Navigation
        \Menu::make('user-dropdown', function ($menu) {

            // Dashboard
            $menu = $menu->add('Home',    ['url'  => url('/').'/home']);
            $menu->link->attr(['class' => 'dropdown__item']);
            // Profile
            $menu = $menu->add('Profile',    ['url'  => url('/').'/user/my']);
            $menu->link->attr(['class' => 'dropdown__item']);
            // Edit Profile
            $menu = $menu->add('Edit Profile',    ['url'  => url('/').'/user/edit']);
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

        return $next($request);
    }
}
