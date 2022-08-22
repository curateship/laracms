@if (Route::has('login'))
<div class="header-v2__nav-control header__icon-btns">

  @auth
  <!-- With avatar -->
  @if(\Illuminate\Support\Facades\Auth::user()->getAvatar()->in_storage)
  <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn switch-icon switch-icon--rotate js-switch-icon js-tab-focus" aria-label="Toggle icon" menu-target="user-menu">
      <div class="mega-nav__icon-btn dropdown__wrapper inline-block author author--minimal-mobile switch-icon__icon switch-icon__icon--a">
          <div class="author__img-wrapper author--minimal-mobile dropdown__trigger object-cover margin-top-xxxs">
              {!! \Illuminate\Support\Facades\Auth::user()->getAvatar()->content !!}
          </div>
      </div>
      <svg class="avatar-cross-fix switch-icon__icon switch-icon__icon--b" viewBox="0 0 20 20">
          <g fill="none" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
              <line x1="15" y1="5" x2="5" y2="15" stroke="currentColor"></line>
              <line x1="15" y1="15" x2="5" y2="5" stroke="currentColor"></line>
          </g>
      </svg>
  </button>

  @else
    <!-- With SVG avatar if no image is uploaded -->
    <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar js-anim-menu-btn padding-top-xxs" aria-label="Toggle icon" menu-target="user-menu">
        {!! \Illuminate\Support\Facades\Auth::user()->getAvatar(true, ['width' => 25, 'height' => 25])->content !!}
    </button>
  @endif

    <!-- Avatar Mobile Dropdown -->
    <nav id="user-menu" class="header-v2__nav header-v2__nav-dropdown">
      <ul class="header-v2__nav-list">
      {!! Menu::get('user-dropdown')->asUl() !!}
       <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown__item">Log Out</a></li>
      </ul>

      <!-- Theme Switch -->
      @include('components.layouts.headers.partials.theme-switch-mobile')
    </nav>

    <!-- User icon if not logged in -->
    @else
    <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar padding-top-xxxxs" aria-controls="modal-login">
      <a href="{{ route('login') }}" class="header-v2__nav-link">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>account</title><g stroke-width="2" fill="#efefef"><path d="M14.08 4.97c0 2.29-1.85 5.81-4.15 5.8s-4.14-3.52-4.14-5.8a4.14 4.14 0 0 1 8.29 0z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3.69 11.6a9.11 9.11 0 0 0-2.65 4.68 15.7 15.7 0 0 0 17.79 0 9.11 9.11 0 0 0-2.64-4.68" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
      </a>
    </button>
  @endif
  @endif