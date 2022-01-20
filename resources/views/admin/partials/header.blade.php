<header class="header-v2 js-header-v2">
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

      <div class="flex">
      <!-- 👇 icon buttons --Mobile -->
        <li class="header__icon-btns margin-left-sm">
            <div class="dropdown inline-block js-dropdown">
              <div class="header__icon-btn dropdown__wrapper inline-block padding-x-sm">
                <a href="#0" class="color-inherit flex height-100% width-100% flex-center dropdown__trigger js-dropdown__trigger">
                  <svg class="icon" viewBox="0 0 24 24">
                    <title>Go to account settings</title>
                    <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
                      <circle cx="12" cy="6" r="4" />
                      <path d="M12 13a8 8 0 00-8 8h16a8 8 0 00-8-8z" />
                    </g>
                  </svg>
                </a>

                <ul class="dropdown__menu js-dropdown__menu" aria-label="submenu">
                  <li><a href="#0" class="dropdown__item">Profile</a></li>
                  <li><a href="#0" class="dropdown__item">Notifications</a></li>
                  <li><a href="#0" class="dropdown__item">Messages</a></li>
                  <li class="dropdown__separator" role="separator"></li>
                  <li><a href="#0" class="dropdown__item">Account Settings</a></li>
                  <li><a href="#0" class="dropdown__item">Log out</a></li>
                </ul>
              </div>
            </div>

            <button class="reset header__icon-btn header__icon-btn--search js-tab-focus" aria-label="Toggle search" aria-controls="modal-search">
              <svg class="icon" viewBox="0 0 24 24">
                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
                  <path d="M4.222 4.222l15.556 15.556" />
                  <path d="M19.778 4.222L4.222 19.778" />
                  <circle cx="9.5" cy="9.5" r="6.5" />
                </g>
              </svg>
            </button>
          </li>
        <!-- icon buttons --Mobile END -->

      <!-- 👇 Mobile Hamburger Menu -->
      <button class="header-v2__nav-control reset anim-menu-btn js-anim-menu-btn js-tab-focus" aria-label="Toggle menu">
        <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
      </button>
      <!-- Mobile Hamburger Menu End -->
      </div>

      <!-- 👇 Navigation Menu -->
      <nav class="header-v2__nav" role="navigation">
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

          <li class="header-v2__nav-item header-v2__nav-item--main"><a href="#0" class="header-v2__nav-link">Pricing</a></li>
        </ul>
        <!-- Navigation Menu End -->

        <!-- 👇 icon buttons --desktop -->
        <li class="header__icon-btns header__icon-btns--desktop margin-left-sm display@md">
            <div class="dropdown inline-block js-dropdown">
              <div class="header__icon-btn dropdown__wrapper inline-block padding-x-sm">
                <a href="#0" class="color-inherit flex height-100% width-100% flex-center dropdown__trigger js-dropdown__trigger">
                  <svg class="icon" viewBox="0 0 24 24">
                    <title>Go to account settings</title>
                    <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
                      <circle cx="12" cy="6" r="4" />
                      <path d="M12 13a8 8 0 00-8 8h16a8 8 0 00-8-8z" />
                    </g>
                  </svg>
                </a>

                <ul class="dropdown__menu js-dropdown__menu" aria-label="submenu">
                  <li><a href="#0" class="dropdown__item">Profile</a></li>
                  <li><a href="#0" class="dropdown__item">Notifications</a></li>
                  <li><a href="#0" class="dropdown__item">Messages</a></li>
                  <li class="dropdown__separator" role="separator"></li>
                  <li><a href="#0" class="dropdown__item">Account Settings</a></li>
                  <li><a href="#0" class="dropdown__item">Log out</a></li>
                </ul>
              </div>
            </div>

            <button class="reset header__icon-btn header__icon-btn--search js-tab-focus" aria-label="Toggle search" aria-controls="modal-search">
              <svg class="icon" viewBox="0 0 24 24">
                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2">
                  <path d="M4.222 4.222l15.556 15.556" />
                  <path d="M19.778 4.222L4.222 19.778" />
                  <circle cx="9.5" cy="9.5" r="6.5" />
                </g>
              </svg>
            </button>
          </li>
          <!-- 👇 icon buttons --desktop END -->

          <!-- 👇 Search Modal --desktop -->
          <div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="modal-search">
            <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
              <form class="full-screen-search">
                <label for="search-input-x" id="modal-search-title" class="sr-only">Search</label>
                <input class="reset full-screen-search__input" type="search" name="search-input-x" id="search-input-x" placeholder="Search...">
                  <button class="reset full-screen-search__btn">
                    <svg class="icon" viewBox="0 0 24 24">
                      <title>Search</title>
                      <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
                      <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
                      <circle cx="10" cy="10" r="8"></circle>
                      </g>
                      </svg>
                  </button>
              </form>
          </div>

          <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
            <svg class="icon icon--sm" viewBox="0 0 24 24">
              <title>Close modal window</title>
              <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" y1="3" x2="21" y2="21" />
              <line x1="21" y1="3" x2="3" y2="21" />
              </g>
            </svg>
            </button>
          </div>
          <!-- Search Modal --desktop End -->

        </ul><!-- List End -->
      </nav><!-- Navigation End -->
    </div>
  </div>
</header>

