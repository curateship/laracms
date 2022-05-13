<header class="header-v2 js-header-v2 hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main">
  <div class="header-v2__wrapper">
    <div class="header-v2__container container max-width-lg">

      <!-- LOGO -->
      <div class="header-v2__logo">
        <a href ="/">
          @include('theme.layouts.svg.logo')
        </a>
      </div>

      <!---Mobile -->
      <div class="flex header-menu-box gap-md">
        @include('components.layouts.headers.partials.mobile-user-dropdown')
        @include('components.layouts.headers.partials.mobile-search')
        <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn" aria-label="Toggle menu" menu-target="main-menu">
          <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
        </button><!-- Mobile Hamburger Menu -->
      </div>

      <!-- Navigation Menu -->
      <nav id="main-menu" class="header-v2__nav" role="navigation">
        <ul class="header-v2__nav-list header-v2__nav-list--main padding-left-xl@md">
        <!-- Custom Menu -->
        @include('components.layouts.headers.partials.custom-menu-items', ['items' => Menu::get('header')->roots()])
        </ul>
      </nav>

      <!--desktop -->
      <div class="header-v2__nav header__icon-btns header-v2__nav-align-right header__icon-btns--desktop">
        @include('components.layouts.headers.partials.desktop-search')
        @include('components.layouts.headers.partials.desktop-user-dropdown')
      </div>

    </div>
  </div>
</header>
