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
    <!-- With SVG avatar -->
    <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar js-anim-menu-btn" aria-label="Toggle icon" menu-target="user-menu">
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
    <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar" aria-controls="modal-login">
      <a href="{{ route('login') }}" class="header-v2__nav-link">
        <svg class="icon" viewBox="0 0 23 23">
          <title>Go to account settings</title>
            <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
              <circle cx="12" cy="6" r="4" />
              <path d="M12 13a8 8 0 00-8 8h16a8 8 0 00-8-8z" />
            </g>
        </svg>
      </a>
    </button>
  @endif
  @endif