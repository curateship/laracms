<header class="header position-relative js-header container max-width-lg padding-x-md padding-x-0@md">
  <div class="header__container">
    <div class="header__logo">
      <a href="/">
        {!! env('LOGO') !!}
      </a>
    </div>

    <div class="width-30% display@md">
      @include('components.layouts.headers.partials.desktop-search')
    </div>

    <button class="btn btn--primary header__trigger js-header__trigger" aria-label="Toggle menu" aria-expanded="false" aria-controls="header-nav">
      <i class="header__trigger-icon" aria-hidden="true"></i>
      <span>Menu</span>
    </button>

    <nav class="header__nav js-header__nav" id="header-nav" role="navigation" aria-label="Main">
    <div class="padding-bottom-xs hide@md">
          @include('components.layouts.headers.partials.desktop-search')
          </div>
      <div class="header__nav-inner">
        <ul class="header__list">
          @include('components.layouts.headers.partials.custom-menu-items', ['items' => Menu::get('header')->roots()])<!-- Custom Menu -->
          @can('is-admin')<!-- is-admin Middleware for Admin Button -->
          <div class="padding-left-md"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></div>
        @endcan
        </ul>
      </div>
    </nav>
  </div>
</header>
