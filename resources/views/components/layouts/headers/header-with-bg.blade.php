<header class="f-header js-f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main border-bottom border-contrast-low border-opacity-20%" data-nav-target-class="f-header--expanded">
    
  <!-- Mobile Navigation -->
  <div class="f-header__mobile-content container max-width-lg">
    <a href="#0" class="">
      {!! env('LOGO_SVG') !!}
    </a>

    <!-- Mobile Animated Button -->
    <button class="reset anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
      <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
    </button>
  </div>

  <!-- Desktop Navigation -->
  <div class="f-header__nav" role="navigation">
    <div class="f-header__nav-grid justify-between@md container max-width-lg">
      <div class="display@md">
        <a href="#0" class="f-header__logo">
          {!! env('LOGO') !!}
        </a>
      </div>

      <ul class="f-header__list flex-basis-0 justify-center@md">
        @include('components.layouts.headers.partials.custom-menu-items', ['items' => Menu::get('header')->roots()])<!-- Custom Menu -->
        @can('is-admin')<!-- is-admin Middleware for Admin Button -->
            <div class="padding-left-md"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></div>
        @endcan
      </ul>
    </div>
  </div>
</header>

@include('components.layouts.partials.hero-random-image')
