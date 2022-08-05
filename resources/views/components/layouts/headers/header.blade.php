<header class="header-v2 js-header-v2 hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main">
  <div class="header-v2__wrapper">
    <div class="header-v2__container container max-width-lg">

      <!-- LOGO -->
      <div class="header-v2__logo">
        <a href ="/">
          {!! env('LOGO') !!}
        </a>
      </div>

      <!--- Mobile -->
      <div class="flex header-menu-box gap-md">

        @include('components.layouts.headers.partials.mobile-user-dropdown')
        @include('components.layouts.headers.partials.mobile-search')

        @auth
          @push('custom-scripts')
              @include('components.layouts.headers.notifications.script-js')
          @endpush
          @include('components.layouts.headers.partials.mobile-notifications')
        @endif

        <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn" aria-label="Toggle menu" menu-target="main-menu">
          <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
        </button><!-- Mobile Hamburger Menu -->

        @can('is-admin')<!-- admin link -->
        <div class="padding-top-xxxs padding-x-xs">
          <a href="/admin">
          <svg class="icon color-contrast-high" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"><title>gear</title><g ><path d="M18.92 8.48a2.5 2.5 0 0 1-1.54-3.71c0.4-0.67 0.28-1.25-0.12-1.65l-0.38-0.38c-0.4-0.4-0.98-0.52-1.65-0.12a2.5 2.5 0 0 1-3.71-1.54c-0.19-0.76-0.68-1.08-1.25-1.08h-0.54c-0.56 0-1.06 0.32-1.25 1.08a2.5 2.5 0 0 1-3.71 1.54c-0.67-0.4-1.25-0.28-1.65 0.12l-0.39 0.38c-0.4 0.4-0.52 0.98-0.11 1.65a2.5 2.5 0 0 1-1.54 3.71c-0.76 0.19-1.08 0.68-1.08 1.25v0.54c0 0.56 0.32 1.06 1.08 1.25a2.5 2.5 0 0 1 1.54 3.71c-0.4 0.67-0.28 1.25 0.12 1.65l0.38 0.38c0.4 0.4 0.98 0.52 1.65 0.12a2.5 2.5 0 0 1 3.71 1.54c0.19 0.76 0.68 1.08 1.25 1.08h0.54c0.56 0 1.06-0.32 1.25-1.08a2.5 2.5 0 0 1 3.71-1.54c0.67 0.4 1.25 0.28 1.65-0.12l0.38-0.38c0.4-0.4 0.52-0.98 0.12-1.65a2.5 2.5 0 0 1 1.54-3.71c0.76-0.19 1.08-0.68 1.08-1.25v-0.54c0-0.56-0.33-1.06-1.08-1.25z m-8.92 5.27a3.75 3.75 0 1 1 0-7.5 3.75 3.75 0 0 1 0 7.5z"></path></g></svg>
          @endcan
          </a>
        </div>
      </div>

      <!-- Navigation -->
      <nav id="main-menu" class="header-v2__nav" role="navigation">
        <ul class="header-v2__nav-list header-v2__nav-list--main padding-left-xl@md">
          @include('components.layouts.headers.partials.custom-menu-items', ['items' => Menu::get('header')->roots()])<!-- Custom Menu -->
        </ul>
      </nav>

      <!--desktop -->
      <div class="header-v2__nav header__icon-btns header-v2__nav-align-right header__icon-btns--desktop">
        @include('components.layouts.headers.partials.desktop-search')

        <div class="padding-left-xs">
          @include('components.layouts.headers.partials.desktop-user-dropdown')
        </div>

        @auth
        <div class="padding-x-xxxs">
          @include('components.layouts.headers.partials.desktop-notifications')
        </div>

        <div class="f-header__item"><a href="/home" class="f-header__btn btn btn--subtle radius-full">Dashboard</a></div>
        @can('is-admin')<!-- is-admin Middleware for Admin Button -->
          <div class="f-header__item"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></div>
        @endcan
        @endif

      </div>

    </div>
  </div>
</header>