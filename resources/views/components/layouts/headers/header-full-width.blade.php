<header class="header position-relative js-header">
  <div class="header__container padding-md padding-lg@md">
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
    <div class="padding-md padding-bottom-xs hide@md">
          @include('components.layouts.headers.partials.desktop-search')
          </div>
      <div class="header__nav-inner">
        <ul class="header__list">
          <li class="header__item">
            <a href="/category/origins" class="header__link" {{ str_replace(url('/'), '', url()->full()) === '/category/origins' ? 'aria-current=page' : '' }}>Origins</a>
          </li>

          <li class="header__item">
            <a href="/category/characters" class="header__link" {{ str_replace(url('/'), '', url()->full()) === '/category/characters' ? 'aria-current=page' : '' }}>Characters</a>
          </li>

          <li class="header__item">
            <a href="/category/artists" class="header__link" {{ str_replace(url('/'), '', url()->full()) === '/category/artists' ? 'aria-current=page' : '' }}>Artists</a>
          </li>

          <li class="header__item">
            <a href="/category/misc" class="header__link" {{ str_replace(url('/'), '', url()->full()) === '/category/misc' ? 'aria-current=page' : '' }}>Misc</a>
          </li>

          <li class="header__item">
            <a href="/category/media" class="header__link" {{ str_replace(url('/'), '', url()->full()) === '/category/media' ? 'aria-current=page' : '' }}>Media</a>
          </li>
          @can('is-admin')<!-- is-admin Middleware for Admin Button -->
          <div class="padding-left-md"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></div>
        @endcan
        </ul>
      </div>
    </nav>
  </div>
</header>
