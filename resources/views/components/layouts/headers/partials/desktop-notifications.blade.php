<button class="reset notif-popover-control js-tab-focus" aria-controls="notifications-popover">
  <svg class="icon" viewBox="0 0 20 20">
    <title>Notifications</title>
    <path d="M16,12V7a6,6,0,0,0-6-6h0A6,6,0,0,0,4,7v5L2,16H18Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" />
    <path d="M7.184,18a2.982,2.982,0,0,0,5.632,0Z" />
  </svg>
  <span class="counter counter-desktop counter--critical counter--docked delete-counter notifications-counter" style="display: none;"><span class="notifications-counter-value"></span> <i class="sr-only">Notifications</i></span>

</button>

<div id="notifications-popover" class="popover notif-popover bg-light radius-md shadow-md js-popover" role="dialog">
  <header class="bg-light bg-opacity-90% backdrop-blur-10 padding-sm shadow-xs position-sticky top-0 z-index-2">
    <div class="flex justify-between items-baseline">
      <h1 class="text-base">Notifications</h1>
      <a class="text-sm" href="#0">View all</a>
    </div>
  </header>

  <div class="notification-list"></div>
</div>
