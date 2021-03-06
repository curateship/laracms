<header class="header-v2 js-header-v2 hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main">
  <div class="header-v2__wrapper">
    <div class="header-v2__container container max-width-lg">

      <!-- 👇 LOGO -->
      <div class="header-v2__logo padding-right-xl">
        <a href="/">
          <svg width="104" height="30" viewBox="0 0 104 30">
            <title>Go to homepage</title>
            <path d="M37.54 24.08V3.72h4.92v16.37h8.47v4zM60.47 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8 8 0 015.64-2.18 8.07 8.07 0 015.68 2.2 8.49 8.49 0 012 5.69 8.63 8.63 0 01-1.78 5.38 7.6 7.6 0 01-5.89 2.49zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.79 3-2.79 4.26.32 4.23 2.82 4.23zM95.49 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8.4 8.4 0 0111.31 0 8.43 8.43 0 012 5.69 8.6 8.6 0 01-1.77 5.38 7.6 7.6 0 01-5.89 2.51zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.8 3-2.8 4.26.31 4.23 2.83 4.23zM77.66 30c-5.74 0-7-3.25-7.23-4.52l4.6-.26c.41.91 1.17 1.41 2.76 1.41a2.45 2.45 0 002.82-2.53v-2.68a7 7 0 01-1.7 1.75 6.12 6.12 0 01-5.85-.08c-2.41-1.37-3-4.25-3-6.66 0-.89.12-3.67 1.45-5.42a5.67 5.67 0 014.64-2.4c1.2 0 3 .25 4.46 2.82V8.81h4.85v15.33a5.2 5.2 0 01-2.12 4.32A9.92 9.92 0 0177.66 30zm.15-9.66c2.53 0 2.81-2.69 2.81-3.91s-.31-4-2.81-4-2.81 2.8-2.81 4 .27 3.91 2.81 3.91zM55.56 3.72h9.81v2.41h-9.81z" fill="var(--color-contrast-higher)" />
            <circle cx="15" cy="15" r="15" fill="var(--color-primary)" />
          </svg>
        </a>
      </div>
      <!-- LOGO End -->

      <div class="flex header-menu-box gap-md">
        <!-- 👇 icon buttons --Mobile -->
        @if (Route::has('login'))
        <div class="header-v2__nav-control header__icon-btns">
            <!-- Mobile User menu -->


            <!-- With avatar -->
            @auth
            <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn switch-icon switch-icon--rotate js-switch-icon js-tab-focus" aria-label="Toggle icon" menu-target="user-menu">
                <div class="mega-nav__icon-btn dropdown__wrapper inline-block author author--minimal-mobile switch-icon__icon switch-icon__icon--a">
                    <div class="author__img-wrapper author--minimal-mobile dropdown__trigger">
                        <img src="{{ 'https://images.assetsdelivery.com/compings_v2/salamatik/salamatik1801/salamatik180100019.jpg'  }}" alt="Logged in user avatar">
                    </div>
                </div>
                <svg class="avatar-cross-fix switch-icon__icon switch-icon__icon--b" viewBox="0 0 20 20">
                    <g fill="none" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                        <line x1="15" y1="5" x2="5" y2="15" stroke="currentColor"></line>
                        <line x1="15" y1="15" x2="5" y2="5" stroke="currentColor"></line>
                    </g>
                </svg>
            </button>
            <!-- End with avatar -->

            <!-- Without With avatar -->
            <!--
            <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar js-anim-menu-btn" aria-label="Toggle icon" menu-target="user-menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                    <title>face-man</title>
                    <g class="icon__group" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(0.5 0.5)" fill="white" stroke="white">
                        <path fill="none" stroke-miterlimit="10"
                              d="M1.051,10.933 C4.239,6.683,9.875,11.542,16,6c3,4.75,6.955,4.996,6.955,4.996"></path>
                        <circle data-stroke="none" fill="currentColor" cx="7.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                stroke-linecap="square" stroke="none"></circle>
                        <circle data-stroke="none" fill="currentColor" cx="16.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                stroke-linecap="square" stroke="none"></circle>
                        <circle fill="none" stroke="currentColor" stroke-miterlimit="10" cx="12" cy="12" r="11"></circle>
                        <path d="M4.222 4.222l15.556 15.556" />
                        <path d="M19.778 4.222L4.222 19.778" />
                    </g>
                </svg>
            </button>
            -->
            <!-- Without With avatar END -->

            <!-- Avatar Mobile Dropdown -->
            <nav id="user-menu" class="header-v2__nav header-v2__nav-dropdown">
                <ul class="header-v2__nav-list">
                 <li><a href="#0" class="dropdown__item">Profile</a></li>
                 <li><a href="#0" class="dropdown__item">Notifications</a></li>
                 <li><a href="#0" class="dropdown__item margin-bottom-sm">Messages</a></li>
                 <div class="border-top border-contrast-lower"></div><!-- Divider -->
                 <li><a href="#0" class="dropdown__item margin-top-xs">Account Settings</a></li>
                 <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown__item">Log Out</a></li>
                </ul>

                <ul class="radio-switch margin-left-xs margin-top-xs">
                  <li class="radio-switch__item">
                    <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-mobile-switch" data-theme="light" id="radio-3" {{auth()->user()->theme() == 'light' ? 'checked' : ''}}>
                    <label class="radio-switch__label" for="radio-3"><svg class="icon icon--xs" viewBox="0 0 16 16">
                        <title>Enable light mode</title>
                        <path d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.414-1.414zM14 7h2v2h-2zM12.95 14.433l-1.415-1.414 1.414-1.414 1.415 1.413zM7 14h2v2H7zM2.98 14.363L1.566 12.95l1.415-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.707L4.465 3.12 3.05 4.535 1.636 3.121z" />
                        <path d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4z" />
                      </svg></label>
                  </li>

                  <li class="radio-switch__item">
                    <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-mobile-switch" data-theme="dark" id="radio-4" {{auth()->user()->theme() == 'dark' ? 'checked' : ''}}>
                    <label class="radio-switch__label" for="radio-4"><svg class="icon icon--xs" viewBox="0 0 16 16">
                        <title>Enable dark mode</title>
                        <path d="M6,0C2.5,0.9,0,4.1,0,7.9C0,12.4,3.6,16,8.1,16c3.8,0,6.9-2.5,7.9-6C9.9,11.7,4.3,6.1,6,0z"></path>
                      </svg></label>
                    <div aria-hidden="true" class="radio-switch__marker"></div>
                  </li>
                </ul>
               </ul>
            </nav>
            <!-- Avatar Mobile Dropdown END-->
            <!-- mobile user menu END-->
            @else
            <button class="header-v2__nav-control reset anim-menu-btn anim-menu-btn--avatar" aria-controls="modal-login">
              <a href="{{ route('login') }}" class="header-v2__nav-link">
                <svg class="icon" viewBox="0 0 23 23">
                  <title>Go to account settings</title>
                    <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
                      <circle cx="12" cy="6" r="4" />
                      <path d="M12 13a8 8 0 00-8 8h16a8 8 0 00-8-8z" />
                    </g>
                </svg>
              </a>
            </button>
            @endif

            @endif
            <!-- Mobile search -->
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
                    <form action="" method="GET">
                        <input type="hidden" name="limit" value="">
                        <input type="hidden" name="sort" value="">
                        <input type="hidden" name="order" value="">
                        <input class="form-control width-100%" type="text" name="q" value="" id="megasite-search" placeholder="Search something" aria-label="Search">
                    </form>
                    <div>
                    </div>
                </div>
            </div>
            <!-- End mobile search -->

          <!-- 👇 Mobile Hamburger Menu -->
          <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn" aria-label="Toggle menu" menu-target="main-menu">
            <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
          </button>
        </div>
        <!-- icon buttons --Mobile END -->

        <!-- 👇 Navigation Menu -->
        <nav id="main-menu" class="header-v2__nav" role="navigation">
          <ul class="header-v2__nav-list header-v2__nav-list--main">

            <li class="header-v2__nav-item header-v2__nav-item--main header-v2__nav-item--has-children">
              <a href="#0" class="header-v2__nav-link">
                <span>Product</span>
                <svg class="header-v2__nav-dropdown-icon icon margin-left-xxxs" aria-hidden="true" viewBox="0 0 16 16">
                  <polyline fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="3.5,6.5 8,11 12.5,6.5 "></polyline>
                </svg>
              </a>

              <div class="header-v2__nav-dropdown header-v2__nav-dropdown--md">
                <ul class="header-v2__nav-list header-v2__nav-list--title-desc">
                  <li class="header-v2__nav-item">
                    <a href="#0" class="header-v2__nav-link">
                      <svg class="header-v2__nav-icon" aria-hidden="true" width="32" height="32" viewBox="0 0 32 32">
                        <circle fill="var(--color-accent)" opacity="0.2" cx="16" cy="16" r="16" />
                        <circle cx="11.5" cy="10.5" r="3.5" fill="var(--color-accent)" />
                        <path d="M22,12,4.729,27.352a15.982,15.982,0,0,0,26.24-5.742Z" fill="var(--color-accent)" />
                      </svg>

                      <div>
                        <strong>Sub nav item</strong>
                        <small>Lorem ipsum dolor sit amet.</small>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="header-v2__nav-item header-v2__nav-item--main header-v2__nav-item--has-children">
              <a href="#0" class="header-v2__nav-link">
                <span>About</span>
                <svg class="header-v2__nav-dropdown-icon icon margin-left-xxxs" aria-hidden="true" viewBox="0 0 16 16">
                  <polyline fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="3.5,6.5 8,11 12.5,6.5 "></polyline>
                </svg>
              </a>

              <div class="header-v2__nav-dropdown header-v2__nav-dropdown--md">
                <ul class="header-v2__nav-list header-v2__nav-list--title-desc">

                  <li class="header-v2__nav-item">
                    <a href="#0" class="header-v2__nav-link">
                      <div>
                        <strong>Sub nav item</strong>
                        <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
                      </div>
                    </a>
                  </li>

                </ul>
              </div>
            </li>

            <li class="header-v2__nav-item header-v2__nav-item--main"><a href="{{ route('contact.create') }}" class="header-v2__nav-link">Contact</a></li>
          </ul>
        </nav>
        <!-- Navigation Menu End -->

        <!-- 👇 icon buttons --desktop -->
        <div class="header-v2__nav header__icon-btns header-v2__nav-align-right header__icon-btns--desktop">

        <!-- 👇 Search --desktop -->
        <div class="search-input search-input--icon-right margin-right-sm">
          <input class="search-input__input form-control radius-full padding-left-sm" type="search" name="search-input" id="search-input" placeholder="Search..." aria-label="Search">
          <button class="search-input__btn">
            <svg class="icon" viewBox="0 0 20 20"><title>Submit</title><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="8" cy="8" r="6"/><line x1="12.242" y1="12.242" x2="18" y2="18"/></g></svg>
          </button>
        </div>
        <!-- Search --desktop END -->

        <!-- 👇 User Avatar and Authentication --desktop -->
        @if (Route::has('login'))
        <ul class="f-header__list flex-grow flex-basis-0 justify-end@md">
          @auth
          <div class="dropdown inline-block js-dropdown">
           <li class="header__icon-btn dropdown__wrapper inline-block margin-right-sm">

              <!-- 👇 With avatar -->
               <a href="#0" class="color-inherit flex height-100% width-100% flex-center dropdown__trigger js-dropdown__trigger">
                  <img class="desktop-user-avatar" src="{{ asset('assets/img/avatar.png') }}" alt="Logged in user avatar">
               </a>

               <!-- avatar Dropdown -->
               <ul id="user-desktop-menu" class="dropdown__menu js-dropdown__menu" aria-label="submenu">
                 <li><a href="#0" class="dropdown__item">Profile</a></li>
                 <li><a href="#0" class="dropdown__item">Notifications</a></li>
                 <li><a href="#0" class="dropdown__item margin-bottom-xs">Messages</a></li>
                 <div class="border-top border-contrast-lower"></div><!-- Divider -->
                 <li><a href="#0" class="dropdown__item margin-top-xxxs">Account Settings</a></li>
                 <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown__item">Log Out</a></li>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                 </form>

                 <ul class="radio-switch margin-left-xs margin-top-xs">
                  <li class="radio-switch__item">
                    <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-desktop-switch" data-theme="light" id="radio-1" {{auth()->user()->theme() == 'light' ? 'checked' : ''}}>
                    <label class="radio-switch__label" for="radio-1"><svg class="icon icon--xs" viewBox="0 0 16 16">
                        <title>Enable light mode</title>
                        <path d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.414-1.414zM14 7h2v2h-2zM12.95 14.433l-1.415-1.414 1.414-1.414 1.415 1.413zM7 14h2v2H7zM2.98 14.363L1.566 12.95l1.415-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.707L4.465 3.12 3.05 4.535 1.636 3.121z" />
                        <path d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4z" />
                      </svg></label>
                  </li>

                  <li class="radio-switch__item">
                    <input class="radio-switch__input sr-only themeSwitch" type="radio" name="radio-desktop-switch" data-theme="dark" id="radio-2" {{auth()->user()->theme() == 'dark' ? 'checked' : ''}}>
                    <label class="radio-switch__label" for="radio-2"><svg class="icon icon--xs" viewBox="0 0 16 16">
                        <title>Enable dark mode</title>
                        <path d="M6,0C2.5,0.9,0,4.1,0,7.9C0,12.4,3.6,16,8.1,16c3.8,0,6.9-2.5,7.9-6C9.9,11.7,4.3,6.1,6,0z"></path>
                      </svg></label>
                    <div aria-hidden="true" class="radio-switch__marker"></div>
                  </li>
                </ul>
               </ul>

            </li>
           </div>
           <!-- With avatar END-->
           <li class="f-header__item"><a href="/home" class="f-header__btn btn btn--subtle radius-full">Dashboard</a></li>
          @can('is-admin')
          <li class="f-header__item"><a href="/admin" class="f-header__btn btn btn--dark radius-full">Admin</a></li>
          @endcan
          @else
          <li class="f-header__item"><a href="{{ route('login') }}" class="f-header__link" aria-controls="modal-login">Login</a></li>
          <li class="f-header__item"><a href="{{ route('register') }}" class="f-header__btn btn btn--primary" aria-controls="modal-signup">Sign up</a></li>
          @endif
        </ul>
        @endif
          <!-- 👇 User Avatar and Authentication --desktop END -->

        </div>
        <!-- 👇 icon buttons --desktop END -->
      </div>
    </div>
  </div>

</header>
