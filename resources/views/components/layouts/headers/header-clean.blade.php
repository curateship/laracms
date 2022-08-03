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

    <!-- Mobile Search -->
    <div class="hide@md padding-left-xxl" aria-controls="modal-search">
      <svg class="icon" viewBox="0 0 24 24">
        <title>Toggle search</title>
        <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
          <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
          <circle cx="10" cy="10" r="8"></circle>
        </g>
      </svg>
    </div>

    <button class="btn btn--primary header__trigger js-header__trigger" aria-label="Toggle menu" aria-expanded="false" aria-controls="header-nav">
      <i class="header__trigger-icon" aria-hidden="true"></i>
      <span>Menu</span>
    </button>

    <!-- Mobile Menu -->
    <nav class="header__nav js-header__nav" id="header-nav" role="navigation" aria-label="Main">
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

<!-- Modal -->
<div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="modal-search">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
    <form class="full-screen-search">
      <label for="search-input-x" id="modal-search-title" class="sr-only">Search</label>
      <input class="reset full-screen-search__input" type="search" name="search-input-x" id="megasite-search" placeholder="Search something" aria-label="Search" value="{{\Illuminate\Support\Facades\Route::currentRouteName() == 'posts.search' ? session('search') : ''}}">
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