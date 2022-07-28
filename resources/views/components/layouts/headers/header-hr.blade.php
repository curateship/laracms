<header class="header position-relative js-header">
  <div class="header__container border-bottom border-contrast-lowest padding-md padding-lg@md">
    <div class="header__logo">
      <a href="/">
        <h1 class="">HentaiRing</h1>
      </a>
    </div>

    <div class="width-40% display@md">
      @include('components.layouts.headers.partials.desktop-search')
    </div>

    <button class="btn btn--subtle header__trigger js-header__trigger" aria-label="Toggle menu" aria-expanded="false" aria-controls="header-nav">
      <i class="header__trigger-icon" aria-hidden="true"></i>
      <span>Menu</span>
    </button>

    <nav class="header__nav js-header__nav" id="header-nav" role="navigation" aria-label="Main">
      <div class="header__nav-inner">
        <div class="header__label">Main menu</div>
        <ul class="header__list">
          <li class="header__item"><a href="/category/origins" class="header__link">Origins</a></li>
          <li class="header__item"><a href="/category/characters" class="header__link">Characters</a></li>
          <li class="header__item"><a href="/category/artists" class="header__link" aria-current="page">Artists</a></li>
          <li class="header__item"><a href="/category/misc" class="header__link">Misc</a></li>
          <li class="header__item"><a href="/category/media" class="header__link">Media</a></li>
          @can('is-admin')<!-- is-admin Middleware for Admin Button -->
          <div class="f-header__item padding-left-md"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></div>
        @endcan
        </ul>
      </div>
    </nav>
  </div>
</header>
