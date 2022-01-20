<!-- Navigation -->
<header class="f-header js-f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main" data-nav-target-class="f-header--expanded" data-theme="dark">
    <div class="f-header__mobile-content container max-width-lg">
      <a href="http://localhost:8000/" class="f-header__logo">
        <svg width="104" height="30" viewBox="0 0 104 30">
          <title>Go to homepage</title>
          <path d="M37.54 24.08V3.72h4.92v16.37h8.47v4zM60.47 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8 8 0 015.64-2.18 8.07 8.07 0 015.68 2.2 8.49 8.49 0 012 5.69 8.63 8.63 0 01-1.78 5.38 7.6 7.6 0 01-5.89 2.49zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.79 3-2.79 4.26.32 4.23 2.82 4.23zM95.49 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8.4 8.4 0 0111.31 0 8.43 8.43 0 012 5.69 8.6 8.6 0 01-1.77 5.38 7.6 7.6 0 01-5.89 2.51zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.8 3-2.8 4.26.31 4.23 2.83 4.23zM77.66 30c-5.74 0-7-3.25-7.23-4.52l4.6-.26c.41.91 1.17 1.41 2.76 1.41a2.45 2.45 0 002.82-2.53v-2.68a7 7 0 01-1.7 1.75 6.12 6.12 0 01-5.85-.08c-2.41-1.37-3-4.25-3-6.66 0-.89.12-3.67 1.45-5.42a5.67 5.67 0 014.64-2.4c1.2 0 3 .25 4.46 2.82V8.81h4.85v15.33a5.2 5.2 0 01-2.12 4.32A9.92 9.92 0 0177.66 30zm.15-9.66c2.53 0 2.81-2.69 2.81-3.91s-.31-4-2.81-4-2.81 2.8-2.81 4 .27 3.91 2.81 3.91zM55.56 3.72h9.81v2.41h-9.81z" fill="var(--color-contrast-higher)" />
          <circle cx="15" cy="15" r="15" fill="var(--color-primary)" />
        </svg>
      </a>

<!-- 👇 icon buttons --mobile -->
<div class="justify-between flex gap-xs"> 
  <div class="mega-nav__icon-btns mega-nav__icon-btns--mobile padding-sm">

<!-- 👇 User Dropdown -->
<div class="icon margin-right-md" aria-controls="modal-login">
  <svg class="icon" viewBox="0 0 20 20">
    <title>User Avatar</title>
    <g fill="currentColor">
      <circle cx="10" cy="4" r="3" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
      <path d="M10 11a8 8 0 0 0-7.562 5.383A2 2 0 0 0 4.347 19h11.306a2 2 0 0 0 1.909-2.617A8 8 0 0 0 10 11z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
    </g>
  </svg>
</div>
<!-- 👇 User Dropdown END -->

<!-- 👇 Full Screen Search -->
<div class="icon" aria-controls="modal-search">
  <svg class="icon" viewBox="0 0 24 24">
    <title>Toggle search</title>
    <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
      <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
      <circle cx="10" cy="10" r="8"></circle>
    </g>
  </svg>
</div>

<div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="modal-search">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto zindex-overlay" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
    <form class="full-screen-search">
      <label for="search-input-x" id="modal-search-title" class="sr-only">Search</label>
      <input class="reset full-screen-search__input" type="search" name="search-input-x" id="search-input-x" placeholder="Search...">
      <button class="reset full-screen-search__btn">
        <svg class="icon" viewBox="0 0 24 24">
          <title>Search</title>
          <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
            <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
            <circle cx="10" cy="10" r="8"></circle>
          </g>
        </svg>
      </button>
    </form>
  </div>

  <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
</div>
<!-- Full Screen Search END -->
</div>
    <button class="reset anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
      <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
    </button>
</div>
</div>
<!-- icon buttons --mobile END -->

<!-- 👇 Navigation --Desktop -->
    <div class="f-header__nav" role="navigation">
      <div class="f-header__nav-grid justify-between@md container max-width-lg">
        <div class="f-header__nav-logo-wrapper flex-grow flex-basis-0">
          <a href="http://localhost:8000/" class="f-header__logo">
            <svg width="104" height="30" viewBox="0 0 104 30">
              <title>Go to homepage</title>
              <path d="M37.54 24.08V3.72h4.92v16.37h8.47v4zM60.47 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8 8 0 015.64-2.18 8.07 8.07 0 015.68 2.2 8.49 8.49 0 012 5.69 8.63 8.63 0 01-1.78 5.38 7.6 7.6 0 01-5.89 2.49zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.79 3-2.79 4.26.32 4.23 2.82 4.23zM95.49 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8.4 8.4 0 0111.31 0 8.43 8.43 0 012 5.69 8.6 8.6 0 01-1.77 5.38 7.6 7.6 0 01-5.89 2.51zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.8 3-2.8 4.26.31 4.23 2.83 4.23zM77.66 30c-5.74 0-7-3.25-7.23-4.52l4.6-.26c.41.91 1.17 1.41 2.76 1.41a2.45 2.45 0 002.82-2.53v-2.68a7 7 0 01-1.7 1.75 6.12 6.12 0 01-5.85-.08c-2.41-1.37-3-4.25-3-6.66 0-.89.12-3.67 1.45-5.42a5.67 5.67 0 014.64-2.4c1.2 0 3 .25 4.46 2.82V8.81h4.85v15.33a5.2 5.2 0 01-2.12 4.32A9.92 9.92 0 0177.66 30zm.15-9.66c2.53 0 2.81-2.69 2.81-3.91s-.31-4-2.81-4-2.81 2.8-2.81 4 .27 3.91 2.81 3.91zM55.56 3.72h9.81v2.41h-9.81z" fill="var(--color-contrast-higher)" />
              <circle cx="15" cy="15" r="15" fill="var(--color-primary)" />
            </svg>
          </a>
        </div>

        <ul class="f-header__list flex-grow flex-basis-0 justify-center@md">
          <li class="f-header__item"><a href="#0" class="f-header__link">About</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">
              <span>Solutions</span>
              <svg class="f-header__dropdown-icon icon" aria-hidden="true" viewBox="0 0 12 12">
                <path d="M9.943,4.269A.5.5,0,0,0,9.5,4h-7a.5.5,0,0,0-.41.787l3.5,5a.5.5,0,0,0,.82,0l3.5-5A.5.5,0,0,0,9.943,4.269Z" />
              </svg>
            </a>
            <ul class="f-header__dropdown">
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item One</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Two</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Three</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Four</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Five</a></li>
            </ul>
          </li>
          <li class="f-header__item"><a href="#0" class="f-header__link" aria-current="page">Resources</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">Pricing</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">Contact</a></li>
        </ul>

        @if (Route::has('login'))
        <ul class="f-header__list flex-grow flex-basis-0 justify-end@md">
          
          @auth
          <li class="f-header__item"><a href="/admin" class="f-header__btn btn btn--subtle">Admin</a></li>
          <li class="f-header__item"><a href="{{ route('logout') }}" class="f-header__btn btn btn--basic" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
            @csrf
          </form>
          @else
          <li class="f-header__item"><a href="{{ route('login') }}" class="f-header__link" aria-controls="modal-login">Login</a></li>
          <li class="f-header__item"><a href="{{ route('register') }}" class="f-header__btn btn btn--primary" aria-controls="modal-signup">Sign up</a></li>
          @endif
          
        </ul>
        @endif
      </div>
    </div>
  </header>
<!-- END -->
