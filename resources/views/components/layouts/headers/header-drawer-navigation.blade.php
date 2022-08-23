<header class="dr-nav-header padding-top-md">
  <div class="container position-relative height-100% flex items-center">
    <a class="dr-nav-header__logo" href="/">
      {!! env('LOGO') !!}
    </a>

    <div class=""><a href="/admin" class="f-header__btn btn btn--primary radius-full">Start here</a></div>


      @can('is-admin')<!-- is-admin Middleware for Admin Button -->
        <div class="margin-left-sm"><a href="/admin" class="f-header__btn btn btn--primary radius-full">Admin</a></div>
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
