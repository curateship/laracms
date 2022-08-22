
<button class="reset notif-popover-control js-tab-focus notifications-bell" aria-controls="notifications-popover">
  <svg class="icon" viewBox="0 0 20 20">
    <title>Notifications</title>
    <path d="M16,12V7a6,6,0,0,0-6-6h0A6,6,0,0,0,4,7v5L2,16H18Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" />
    <path d="M7.184,18a2.982,2.982,0,0,0,5.632,0Z" />
  </svg>
  <span class="counter counter-desktop counter--critical counter--docked delete-counter notifications-counter" style="display: none;"><span class="notifications-counter-value"></span> <i class="sr-only">Notifications</i></span>
</button>

<div id="notifications-popover" class="popover notif-popover bg-light radius-md shadow-md js-popover" role="dialog">
  <header class="bg-light bg-opacity-90% backdrop-blur-10 shadow-xs position-sticky top-0 z-index-2">
    <div class="flex justify-between items-baseline padding-xxxs">
      <h1 class="text-base padding-left-sm">Notifications</h1>

      <!-- Delete -->
        <div class="menu-bar__item clear-notifications" role="menuitem">
          <svg class="icon color-contrast-low" aria-hidden="true" viewBox="0 0 16 16">
            <g><path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path><path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path></g>
          </svg>
          <span class="menu-bar__label">Clear</span>
        </div>

    </div>
  </header>

  <div class="notification-list custom-scrollbar" style="max-height: 400px; overflow-y: auto;"></div>

  <div class="border-top border-contrast-lower opacity-80%"></div><!-- Divider -->
  <div class="bg-light bg-opacity-90% backdrop-blur-10 shadow-xs position-sticky top-0 z-index-2 padding-xs text-center">

    <a class="text-sm color-contrast-low link-plain" href="#0">View all
      <svg class="icon color-contrast-low padding-top-xxxs" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
    </a>

  </div>

</div>

