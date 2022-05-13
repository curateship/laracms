<button class="reset notif-popover-control js-tab-focus" aria-controls="notifications-popover">
  <svg class="icon" viewBox="0 0 19 19">
    <title>Notifications</title>
    <path d="M16,12V7a6,6,0,0,0-6-6h0A6,6,0,0,0,4,7v5L2,16H18Z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="1" />
    <path d="M7.184,18a2.982,2.982,0,0,0,5.632,0Z" />
  </svg>
</button>

<div id="notifications-popover" class="popover notif-popover bg-light radius-md shadow-md js-popover" role="dialog">
  <header class="bg-light bg-opacity-90% backdrop-blur-10 padding-sm shadow-xs position-sticky top-0 z-index-2">
    <div class="flex justify-between items-baseline">
      <h1 class="text-base">Notifications</h1>
      <a class="text-sm" href="#0">View all</a>
    </div>
  </header>

  <ul class="notif ">

    <li class="notif__item ">
      <a class="notif__link flex padding-sm" href="#0">
        <figure class="notif__figure margin-right-xs color-primary" aria-hidden="true">
          <img src="../../../app/assets/img/notifications-img-1.jpg" alt="user picture">
        </figure>

        <div class="flex-grow margin-right-xs">

          <div>
            <p class="text-sm"><i class="font-semibold">Olivia Saturday</i> commented on your <i class="font-semibold">"This is all it takes to improve..."</i> post.</p>
            <p class="text-xs color-contrast-medium margin-top-xxxxs"><time>1 hour ago</time></p>
          </div>
        </div>

        <div class="notif__dot margin-left-auto" aria-hidden="true"></div>
      </a>
    </li>

    <li class="notif__item ">
      <a class="notif__link flex padding-sm" href="#0">
        <figure class="notif__figure margin-right-xs color-accent" aria-hidden="true">
          <img src="../../../app/assets/img/notifications-img-2.jpg" alt="user picture">
        </figure>

        <div class="flex-grow margin-right-xs">

          <div>
            <p class="text-sm">It's <i class="font-semibold">David Smith</i>'s birthday. Wish him well!</p>
            <p class="text-xs color-contrast-medium margin-top-xxxxs"><time>12 hours ago</time></p>
          </div>
        </div>

        <div class="notif__dot margin-left-auto" aria-hidden="true"></div>
      </a>
    </li>

    <li class="notif__item ">
      <a class="notif__link flex padding-sm" href="#0">
        <figure class="notif__figure margin-right-xs color-primary" aria-hidden="true">
          <img src="../../../app/assets/img/notifications-img-3.jpg" alt="user picture">
        </figure>

        <div class="flex-grow margin-right-xs">

          <div>
            <p class="text-sm"><i class="font-semibold">Marta Rossi</i> posted <i class="font-semibold">"10 helpful tips to learn web design"</i>.</p>
            <p class="text-xs color-contrast-medium margin-top-xxxxs"><time>a day ago</time></p>

            <div class="bg-light radius-md padding-xs inner-glow shadow-sm margin-top-sm text-sm">
              <p class="color-contrast-medium line-height-lg">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum beatae commodi quibusdam officiis...</p>
            </div>
          </div>
        </div>

      </a>
    </li>

  </ul>
</div>