<button class="reset js-tab-focus anim-menu-btn anim-menu-btn--notifications js-anim-menu-btn" aria-controls="notifications-popover">
  <svg class="icon" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor">
    <title>Notifications</title>
      <g class="icon__group">
          <path d="M16,12V7a6,6,0,0,0-6-6h0A6,6,0,0,0,4,7v5L2,16H18Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" />
          <path d="M7.184,18a2.982,2.982,0,0,0,5.632,0Z" />
          <path d="M4.222 4.222l15.556 15.556" />
          <path d="M19.778 4.222L4.222 19.778" />
      </g>
  </svg>
</button>

<div id="notifications-popover" class="popover notif-popover bg-light radius-md shadow-md js-popover" role="dialog">
  <header class="bg-light bg-opacity-90% backdrop-blur-10 padding-sm shadow-xs position-sticky top-0 z-index-2">
    <div class="flex justify-between items-baseline">
    <h1 class="text-base color-contrast-medium">Notifications</h1>
      <a class="text-sm link-plain" href="#0">View all</a>
    </div>
  </header>

  <ul class="notif ">

    <li class="notif__item ">
      <a class="notif__link flex padding-sm" href="#0">
        <figure class="notif__figure margin-right-xs color-accent" aria-hidden="true">
          <img src="https://codyhouse.co/app/assets/img/notifications-img-3.jpg" alt="user picture">
        </figure>

        <div class="flex-grow margin-right-xs">

          <div>
            <p class="text-sm"><i class="font-semibold">David Smith</i> Added a new post: How to gain muscle in 3 months</p>
            <p class="text-xs color-contrast-medium margin-top-xxxxs"><time>12 hours ago</time></p>
          </div>
        </div>

        <div class="notif__dot margin-left-auto" aria-hidden="true"></div>
      </a>
    </li>

  </ul>
</div>
