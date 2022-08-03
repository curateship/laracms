<!-- User Avatar and Authentication --desktop -->
@if (Route::has('login'))
<ul class="f-header__list flex-grow flex-basis-0 justify-end@md">
@auth
  <div class="dropdown inline-block js-dropdown">
   <li class="header__icon-btn dropdown__wrapper inline-block">

<!-- With avatar -->
  <a href="#0" class="color-inherit flex flex-center js-dropdown__trigger">
     @if(\Illuminate\Support\Facades\Auth::user()->thumbnail != '')
         <img class="desktop-user-avatar radius-50% object-cover" src="{{ url('/storage'.config('images.users_storage_path').\Illuminate\Support\Facades\Auth::user()->thumbnail) }}" alt="Logged in user avatar">
     @else
         <!-- Without avatar -->
         <button class="reset anim-menu-btn anim-menu-btn--avatar js-anim-menu-btn menu-bar__item" aria-label="Toggle icon" menu-target="user-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>account</title><g stroke-width="2" fill=“currentColor”><path d="M14.08 4.97c0 2.29-1.85 5.81-4.15 5.8s-4.14-3.52-4.14-5.8a4.14 4.14 0 0 1 8.29 0z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3.69 11.6a9.11 9.11 0 0 0-2.65 4.68 15.7 15.7 0 0 0 17.79 0 9.11 9.11 0 0 0-2.64-4.68" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
         </button>
     @endif
  </a>

  <!-- avatar Dropdown -->
  <ul id="user-desktop-menu" class="dropdown__menu js-dropdown__menu" aria-label="submenu">

    <!-- Middleware Menu -->
    {!! Menu::get('user-dropdown')->asUl() !!}
    
    <!-- Log-out and hidden form -->
    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown__item">Log Out</a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
      @csrf
    </form>

    <!-- Theme Switch Component -->
    @include('components.layouts.headers.partials.theme-switch-desktop')
    </li>
    </div>

    <!-- Login and Signup for not logged in -->
    @else
    <li class="f-header__item"><a href="{{ route('login') }}" class="f-header__link" aria-controls="modal-login">Login</a></li>
    <li class="f-header__item"><a href="{{ route('register') }}" class="f-header__btn btn btn--primary" aria-controls="modal-signup">Sign up</a></li>
    @endif

  </ul>
  @endif