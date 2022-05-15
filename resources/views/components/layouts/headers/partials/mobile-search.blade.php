<button class="padding-top-xxxxs padding-left-xxxs header-v2__nav-control reset anim-menu-btn anim-menu-btn--search js-anim-menu-btn" aria-label="Toggle search" menu-target="search-menu">
    <svg class="icon" viewBox="0 0 24 24">
        <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
            <path d="M4.222 4.222l15.556 15.556" />
            <path d="M19.778 4.222L4.222 19.778" />
            <circle cx="9.5" cy="9.5" r="6.5" />
        </g>
    </svg>
</button>

<!-- Search Box -->
<div id="search-menu" class="header-v2__nav header-v2__nav-search">
  <div class="">
    <input type="hidden" name="limit" value="">
      <input type="hidden" name="sort" value="">
      <input type="hidden" name="order" value="">
      <input class="form-control width-100%" type="text" name="search-input"  id="megasite-search" placeholder="Search something" aria-label="Search" value="{{\Illuminate\Support\Facades\Route::currentRouteName() == 'posts.search' ? session('search') : ''}}">
    </div>
</div>