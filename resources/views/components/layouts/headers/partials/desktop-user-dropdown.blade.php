<!-- User Avatar and Authentication --desktop -->
@if (Route::has('login'))
<ul class="f-header__list flex-grow flex-basis-0 justify-end@md">
@auth
  <div class="dropdown inline-block js-dropdown">
   <li class="header__icon-btn dropdown__wrapper inline-block">

<!-- With avatar -->
  <a href="#0" class="color-inherit flex height-100% width-100% flex-center dropdown__trigger js-dropdown__trigger">
     @if(\Illuminate\Support\Facades\Auth::user()->thumbnail != '')
         <img class="desktop-user-avatar radius-50% object-cover" src="{{ url('/storage'.config('images.users_storage_path').\Illuminate\Support\Facades\Auth::user()->thumbnail) }}" alt="Logged in user avatar">
     @else
         <!-- Without With avatar -->
         <button class="reset anim-menu-btn anim-menu-btn--avatar js-anim-menu-btn" aria-label="Toggle icon" menu-target="user-menu">
             <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                 <title>face-man</title>
                 <g class="icon__group" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(0.5 0.5)" fill="currentColor" stroke="currentColor">
                     <path fill="none" stroke-miterlimit="10"
                           d="M1.051,10.933 C4.239,6.683,9.875,11.542,16,6c3,4.75,6.955,4.996,6.955,4.996"></path>
                     <circle data-stroke="none" fill="currentColor" cx="7.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                             stroke-linecap="square" stroke="none"></circle>
                     <circle data-stroke="none" fill="currentColor" cx="16.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                             stroke-linecap="square" stroke="none"></circle>
                     <circle fill="none" stroke="currentColor" stroke-miterlimit="10" cx="12" cy="12" r="11"></circle>
                     <path d="M4.222 4.222l15.556 15.556" />
                     <path d="M19.778 4.222L4.222 19.778" />
                 </g>
             </svg>
         </button>
         <!-- Without With avatar END -->
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
    </div><!-- With avatar END-->
      <div class="padding-x-xxxs">
      @include('components.layouts.headers.partials.desktop-notifications')        
      </div>
    <li class="f-header__item"><a href="/home" class="f-header__btn btn btn--subtle radius-full">Dashboard</a></li>

    <!-- is-admin Middleware for Admin Button -->
    @can('is-admin')
    <li class="f-header__item"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></li>
    @endcan

    <!-- Login and Signup for not logged in -->
    @else
    <li class="f-header__item"><a href="{{ route('login') }}" class="f-header__link" aria-controls="modal-login">Login</a></li>
    <li class="f-header__item"><a href="{{ route('register') }}" class="f-header__btn btn btn--primary" aria-controls="modal-signup">Sign up</a></li>
    @endif

  </ul>
  @endif