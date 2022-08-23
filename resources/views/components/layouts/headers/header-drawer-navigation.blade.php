<header class="dr-nav-header padding-top-md">
  <div class="container position-relative height-100% flex items-center">
    <a class="dr-nav-header__logo" href="/">
      <img class="radius-full object-cover" src="http://127.0.0.1:8000/assets/img/1.png">
    </a>

      <ul class="radio-switch" id="theme-switch">
        <li class="radio-switch__item">
          <input class="radio-switch__input sr-only" type="radio" name="radio-switch-name" id="radio-1" value="light" checked>
          <label class="radio-switch__label" for="radio-1"><svg class="icon icon--xs" viewBox="0 0 16 16">
              <title>Enable light mode</title>
              <path d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.414-1.414zM14 7h2v2h-2zM12.95 14.433l-1.415-1.414 1.414-1.414 1.415 1.413zM7 14h2v2H7zM2.98 14.363L1.566 12.95l1.415-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.707L4.465 3.12 3.05 4.535 1.636 3.121z" />
              <path d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4z" />
            </svg></label>
        </li>
  
        <li class="radio-switch__item">
          <input class="radio-switch__input sr-only" type="radio" name="radio-switch-name" id="radio-2" value="dark">
          <label class="radio-switch__label" for="radio-2"><svg class="icon icon--xs" viewBox="0 0 16 16">
              <title>Enable dark mode</title>
              <path d="M6,0C2.5,0.9,0,4.1,0,7.9C0,12.4,3.6,16,8.1,16c3.8,0,6.9-2.5,7.9-6C9.9,11.7,4.3,6.1,6,0z"></path>
            </svg></label>
          <div aria-hidden="true" class="radio-switch__marker"></div>
        </li>
      </ul>

      @can('is-admin')<!-- is-admin Middleware for Admin Button -->
        <div class="f-header__item margin-left-sm"><a href="/admin" class="f-header__btn btn btn--primary radius-full">Admin</a></div>
      @endcan
  </div>
</header>

<div class="drawer js-drawer" id="dr-nav-id">
  <div class="drawer__content bg-light inner-glow shadow-md" role="alertdialog" aria-labelledby="dr-nav-title">
    <div class="drawer__body flex flex-column js-drawer__body">
      <header class="dr-nav-drawer-header padding-x-md">
        <h4 id="dr-nav-title">Menu</h4>
      </header>

      <nav class="dr-nav padding-md" aria-label="Main">
        <ul>

          <li>
            <a class="dr-nav__link" href="#0">
              <span>Life</span>
              <span>18</span>
            </a>
          </li>
        </ul>
      </nav>

      <footer class="padding-md margin-top-auto">
        <div class="search-input search-input--icon-right">
          <input class="search-input__input form-control" type="search" placeholder="Search..." aria-label="Search">
          <button class="search-input__btn">
            <svg class="icon" viewBox="0 0 20 20">
              <title>Submit</title>
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <circle cx="8" cy="8" r="6" />
                <line x1="12.242" y1="12.242" x2="18" y2="18" />
              </g>
            </svg>
          </button>
        </div>
      </footer>
    </div>
  </div>
</div>

<div class="dr-nav-control-wrapper padding-top-sm">
  <div class="container height-100% flex items-center">
    <button class="reset margin-left-auto dr-nav-control anim-menu-btn js-anim-menu-btn js-dr-nav-control js-tab-focus" aria-label="Toggle navigation" aria-controls="dr-nav-id">
      <svg class="dr-nav-control__bg" aria-hidden="true" viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="22" stroke-miterlimit="10" />
      </svg>
      <i class="anim-menu-btn__icon anim-menu-btn__icon--arrow-right" aria-hidden="true"></i>
    </button>
  </div>
</div>
