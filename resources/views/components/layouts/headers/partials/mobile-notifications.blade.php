<button class="reset js-tab-focus anim-menu-btn anim-menu-btn--notifications js-anim-menu-btn notifications-bell" aria-label="Toggle Notifications" menu-target="notifications-menu">
  <svg class="icon" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor">
    <title>Notifications</title>
      <g class="icon__group">
          <path d="M16,12V7a6,6,0,0,0-6-6h0A6,6,0,0,0,4,7v5L2,16H18Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" />
          <path d="M7.184,18a2.982,2.982,0,0,0,5.632,0Z" />
          <path d="M4.222 4.222l15.556 15.556" />
          <path d="M19.778 4.222L4.222 19.778" />
      </g>
  </svg>
  <span class="counter counter--critical counter--docked delete-counter notifications-counter" style="display: none;"><span class="notifications-counter-value"></span> <i class="sr-only">Notifications</i></span>

</button>

<div id="notifications-menu" class="header-v2__nav">
  <header class="position-sticky top-0 z-index-2">
    <div class="flex justify-between items-baseline">
    <h1 class="text-base color-contrast-medium">Notifications</h1>
      <a class="text-sm link-plain" href="#0">View all</a>

    </div>
  </header>

  <div class="notification-list"></div>
</div>
