<header class="dr-nav-header padding-top-md">
  <div class="position-relative height-100% flex">
    <a class="dr-nav-header__logo" href="/">
      {!! env('LOGO') !!}
    </a>

    <div class="confetti-btn inline-block position-relative js-confetti-btn">
  <button class="confetti-btn__btn btn btn--subtle js-confetti-btn__btn radius-full">Start here</button>

  <svg class="confetti-btn__icon color-warning js-confetti-btn__icon" viewBox="0 0 16 16" aria-hidden="true">
    <circle class="conf-btn-svg-item-0" fill="currentColor" cx="8" cy="8" r="8"/>
    <path class="conf-btn-svg-item-1" fill="currentColor" d="M15.836,5.693a.5.5,0,0,0-.4-.34l-4.827-.7L8.448.279a.519.519,0,0,0-.9,0L5.394,4.651l-4.826.7a.5.5,0,0,0-.277.853l3.492,3.4-.825,4.806A.5.5,0,0,0,3.451,15a.493.493,0,0,0,.233-.058L8,12.673l4.316,2.269a.5.5,0,0,0,.726-.527l-.825-4.806,3.492-3.4A.5.5,0,0,0,15.836,5.693Z"/>
    <path class="conf-btn-svg-item-2" fill="currentColor" d="M15.836,5.693a.5.5,0,0,0-.4-.34l-4.827-.7L8.448.279a.519.519,0,0,0-.9,0L5.394,4.651l-4.826.7a.5.5,0,0,0-.277.853l3.492,3.4-.825,4.806A.5.5,0,0,0,3.451,15a.493.493,0,0,0,.233-.058L8,12.673l4.316,2.269a.5.5,0,0,0,.726-.527l-.825-4.806,3.492-3.4A.5.5,0,0,0,15.836,5.693Z"/>
    <path class="conf-btn-svg-item-3" fill="currentColor" d="M15.836,5.693a.5.5,0,0,0-.4-.34l-4.827-.7L8.448.279a.519.519,0,0,0-.9,0L5.394,4.651l-4.826.7a.5.5,0,0,0-.277.853l3.492,3.4-.825,4.806A.5.5,0,0,0,3.451,15a.493.493,0,0,0,.233-.058L8,12.673l4.316,2.269a.5.5,0,0,0,.726-.527l-.825-4.806,3.492-3.4A.5.5,0,0,0,15.836,5.693Z"/>
    <path class="conf-btn-svg-item-4" fill="currentColor" d="M15.836,5.693a.5.5,0,0,0-.4-.34l-4.827-.7L8.448.279a.519.519,0,0,0-.9,0L5.394,4.651l-4.826.7a.5.5,0,0,0-.277.853l3.492,3.4-.825,4.806A.5.5,0,0,0,3.451,15a.493.493,0,0,0,.233-.058L8,12.673l4.316,2.269a.5.5,0,0,0,.726-.527l-.825-4.806,3.492-3.4A.5.5,0,0,0,15.836,5.693Z"/>
    <path class="conf-btn-svg-item-5" fill="currentColor" d="M15.836,5.693a.5.5,0,0,0-.4-.34l-4.827-.7L8.448.279a.519.519,0,0,0-.9,0L5.394,4.651l-4.826.7a.5.5,0,0,0-.277.853l3.492,3.4-.825,4.806A.5.5,0,0,0,3.451,15a.493.493,0,0,0,.233-.058L8,12.673l4.316,2.269a.5.5,0,0,0,.726-.527l-.825-4.806,3.492-3.4A.5.5,0,0,0,15.836,5.693Z"/></svg>
  </svg>
</div>


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

      <footer class="padding-md margin-top-auto max-width-lg">
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
  <div class="container height-100% flex items-center max-width-lg">
    <button class="reset margin-left-auto dr-nav-control anim-menu-btn js-anim-menu-btn js-dr-nav-control js-tab-focus" aria-label="Toggle navigation" aria-controls="dr-nav-id">
      <svg class="dr-nav-control__bg" aria-hidden="true" viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="22" stroke-miterlimit="10" />
      </svg>
      <i class="anim-menu-btn__icon anim-menu-btn__icon--arrow-right" aria-hidden="true"></i>
    </button>
  </div>
</div>
