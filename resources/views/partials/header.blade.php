<!-- Navigation -->
<header class="f-header js-f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main" data-nav-target-class="f-header--expanded" data-theme="dark">
    <div class="f-header__mobile-content container max-width-lg">
      <a href="http://localhost:8000/" class="f-header__logo">
        <svg width="104" height="30" viewBox="0 0 104 30">
          <title>Go to homepage</title>
          <path d="M37.54 24.08V3.72h4.92v16.37h8.47v4zM60.47 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8 8 0 015.64-2.18 8.07 8.07 0 015.68 2.2 8.49 8.49 0 012 5.69 8.63 8.63 0 01-1.78 5.38 7.6 7.6 0 01-5.89 2.49zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.79 3-2.79 4.26.32 4.23 2.82 4.23zM95.49 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8.4 8.4 0 0111.31 0 8.43 8.43 0 012 5.69 8.6 8.6 0 01-1.77 5.38 7.6 7.6 0 01-5.89 2.51zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.8 3-2.8 4.26.31 4.23 2.83 4.23zM77.66 30c-5.74 0-7-3.25-7.23-4.52l4.6-.26c.41.91 1.17 1.41 2.76 1.41a2.45 2.45 0 002.82-2.53v-2.68a7 7 0 01-1.7 1.75 6.12 6.12 0 01-5.85-.08c-2.41-1.37-3-4.25-3-6.66 0-.89.12-3.67 1.45-5.42a5.67 5.67 0 014.64-2.4c1.2 0 3 .25 4.46 2.82V8.81h4.85v15.33a5.2 5.2 0 01-2.12 4.32A9.92 9.92 0 0177.66 30zm.15-9.66c2.53 0 2.81-2.69 2.81-3.91s-.31-4-2.81-4-2.81 2.8-2.81 4 .27 3.91 2.81 3.91zM55.56 3.72h9.81v2.41h-9.81z" fill="var(--color-contrast-higher)" />
          <circle cx="15" cy="15" r="15" fill="var(--color-primary)" />
        </svg>
      </a>

<!-- 👇 icon buttons --mobile -->
<div class="justify-between flex gap-xs"> 
  <div class="mega-nav__icon-btns mega-nav__icon-btns--mobile padding-sm">

<!-- 👇 User Dropdown -->
<div class="icon margin-right-md" aria-controls="modal-login">
  <svg class="icon" viewBox="0 0 20 20">
    <title>User Avatar</title>
    <g fill="currentColor">
      <circle cx="10" cy="4" r="3" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
      <path d="M10 11a8 8 0 0 0-7.562 5.383A2 2 0 0 0 4.347 19h11.306a2 2 0 0 0 1.909-2.617A8 8 0 0 0 10 11z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
    </g>
  </svg>
</div>
<!-- 👇 User Dropdown END -->

<!-- 👇 Full Screen Search -->
<div class="icon" aria-controls="modal-search">
  <svg class="icon" viewBox="0 0 24 24">
    <title>Toggle search</title>
    <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
      <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
      <circle cx="10" cy="10" r="8"></circle>
    </g>
  </svg>
</div>

<div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="modal-search">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto zindex-overlay" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
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
<!-- Full Screen Search END -->
</div>
    <button class="reset anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
      <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
    </button>
</div>
</div>
<!-- icon buttons --mobile END -->

<!-- 👇 Navigation --Desktop -->
    <div class="f-header__nav" role="navigation">
      <div class="f-header__nav-grid justify-between@md container max-width-lg">
        <div class="f-header__nav-logo-wrapper flex-grow flex-basis-0">
          <a href="http://localhost:8000/" class="f-header__logo">
            <svg width="104" height="30" viewBox="0 0 104 30">
              <title>Go to homepage</title>
              <path d="M37.54 24.08V3.72h4.92v16.37h8.47v4zM60.47 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8 8 0 015.64-2.18 8.07 8.07 0 015.68 2.2 8.49 8.49 0 012 5.69 8.63 8.63 0 01-1.78 5.38 7.6 7.6 0 01-5.89 2.49zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.79 3-2.79 4.26.32 4.23 2.82 4.23zM95.49 24.37a7.82 7.82 0 01-5.73-2.25 8.36 8.36 0 01-2-5.62 8.32 8.32 0 012.08-5.71 8.4 8.4 0 0111.31 0 8.43 8.43 0 012 5.69 8.6 8.6 0 01-1.77 5.38 7.6 7.6 0 01-5.89 2.51zm0-3.67c2.42 0 2.73-3 2.73-4.23s-.31-4.26-2.73-4.26-2.8 3-2.8 4.26.31 4.23 2.83 4.23zM77.66 30c-5.74 0-7-3.25-7.23-4.52l4.6-.26c.41.91 1.17 1.41 2.76 1.41a2.45 2.45 0 002.82-2.53v-2.68a7 7 0 01-1.7 1.75 6.12 6.12 0 01-5.85-.08c-2.41-1.37-3-4.25-3-6.66 0-.89.12-3.67 1.45-5.42a5.67 5.67 0 014.64-2.4c1.2 0 3 .25 4.46 2.82V8.81h4.85v15.33a5.2 5.2 0 01-2.12 4.32A9.92 9.92 0 0177.66 30zm.15-9.66c2.53 0 2.81-2.69 2.81-3.91s-.31-4-2.81-4-2.81 2.8-2.81 4 .27 3.91 2.81 3.91zM55.56 3.72h9.81v2.41h-9.81z" fill="var(--color-contrast-higher)" />
              <circle cx="15" cy="15" r="15" fill="var(--color-primary)" />
            </svg>
          </a>
        </div>

        <ul class="f-header__list flex-grow flex-basis-0 justify-center@md">
          <li class="f-header__item"><a href="#0" class="f-header__link">About</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">
              <span>Solutions</span>
              <svg class="f-header__dropdown-icon icon" aria-hidden="true" viewBox="0 0 12 12">
                <path d="M9.943,4.269A.5.5,0,0,0,9.5,4h-7a.5.5,0,0,0-.41.787l3.5,5a.5.5,0,0,0,.82,0l3.5-5A.5.5,0,0,0,9.943,4.269Z" />
              </svg>
            </a>
            <ul class="f-header__dropdown">
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item One</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Two</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Three</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Four</a></li>
              <li><a href="#0" class="f-header__dropdown-link">Sub Nav Item Five</a></li>
            </ul>
          </li>
          <li class="f-header__item"><a href="#0" class="f-header__link" aria-current="page">Resources</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">Pricing</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__link">Contact</a></li>
        </ul>

        <ul class="f-header__list flex-grow flex-basis-0 justify-end@md">
          <li class="f-header__item"><a href="/login" class="f-header__link">Login</a></li>
          <li class="f-header__item"><a href="#0" class="f-header__btn btn btn--primary" aria-controls="modal-signup">Sign up</a></li>
        </ul>
      </div>
    </div>
  </header>
<!-- END -->

<!-- Login Modal Start 👇-->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="modal-login">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">

    <div class="max-width-xs margin-x-auto">
      <div class="margin-bottom-xs">
        <svg class="icon icon--xl" viewBox="0 0 64 64" aria-hidden="true"><path d="M54.053,33.3l-21-13a2,2,0,0,0-2.106,0l-21,13A2,2,0,0,0,9,35V58a2,2,0,0,0,2,2H53a2,2,0,0,0,2-2V35A2,2,0,0,0,54.053,33.3Z" fill="#212121"/><path d="M47,51H17V16a2,2,0,0,1,2-2H45a2,2,0,0,1,2,2Z" fill="#e3e3e3"/><path d="M40,23H24a1,1,0,0,1,0-2H40a1,1,0,0,1,0,2Z" fill="#aeaeae"/><path d="M40,30H24a1,1,0,0,1,0-2H40a1,1,0,0,1,0,2Z" fill="#aeaeae"/><path d="M33,37H24a1,1,0,0,1,0-2h9a1,1,0,0,1,0,2Z" fill="#aeaeae"/><path d="M55,35,32,45.867,9,35V58c0,.015,0,.029,0,.044a1.927,1.927,0,0,0,.027.26c.006.04.008.081.016.12l0,.016c0,.006.006.009.008.014A2,2,0,0,0,11,60H53a2,2,0,0,0,1.951-1.56A1.916,1.916,0,0,0,55,58.022c0-.008.006-.013.006-.022Z" fill="#949494"/><path d="M13,7.029a3,3,0,0,1-3-3,1,1,0,0,0-2,0,3,3,0,0,1-3,3,1,1,0,0,0,0,2,3,3,0,0,1,3,3,1,1,0,0,0,2,0,3,3,0,0,1,3-3,1,1,0,0,0,0-2Z" fill="#ffd764"/><circle cx="55" cy="14" r="3" fill="#ff7163"/></svg>
      </div>

      <div class="text-component margin-bottom-md">
        <h3>LOGIN</h3>
        <a href="#0" class="f-header__btn btn btn--primary" aria-controls="modal-form">Sign up</a>
      </div>

      <form class="grid gap-xxs">
        <input class="form-control" aria-label="Email" type="email" placeholder="Email Address">
        <button class="btn btn--primary">Subscribe</button>
      </form>

      <p class="text-sm bg-success bg-opacity-20% padding-xs radius-md margin-top-xs" role="alert"><strong>✔ Success!</strong> Welcome aboard, friend!</p>

      <div class="margin-top-sm">
        <p class="color-contrast-medium text-sm">No spam. Unsubscribe anytime.</p>
      </div>
    </div>

    <div class="text-component">
      <p class="text-xs color-contrast-medium">Lorem ipsum dolor sit, amet <a href="#0" class="color-contrast-high">consectetur adipisicing</a> elit. Nisi molestias hic voluptatibus.</p>
    </div>
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
<!-- Login Modal END-->

<!-- Signup Modal Start 👇-->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="modal-signup">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">
    <div class="max-width-xs margin-x-auto">

    <form class="sign-up-form">
  <div class="text-component text-center margin-bottom-sm">
    <h1>Get started</h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. <br>
    Already have an account? <a href="#0" class="btn btn--primary" aria-controls="modal-login">Login</a></p>
  </div>

  <div class="grid gap-xs">
    <div class="col-7@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path></g></svg>
        <span>Join using Twitter</span>
      </button>
    </div>
    
    <div class="col-7@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M15.3,0H0.7C0.3,0,0,0.3,0,0.7v14.7C0,15.7,0.3,16,0.7,16H8v-5H6V8h2V6c0-2.1,1.2-3,3-3 c0.9,0,1.8,0,2,0v3h-1c-0.6,0-1,0.4-1,1v1h2.6L13,11h-2v5h4.3c0.4,0,0.7-0.3,0.7-0.7V0.7C16,0.3,15.7,0,15.3,0z"></path></g></svg>
        <span>Join using Facebook</span>
      </button>
    </div>
  </div>

  <p class="text-center margin-y-sm">or</p>

  <div class="margin-bottom-sm">
    <div class="grid gap-xs">
      <div class="col-7@md">
        <label class="form-label margin-bottom-xxxs" for="input-first-name">First name</label>
        <input class="form-control width-100%" type="text" name="input-first-name" id="input-first-name">
      </div>

      <div class="col-7@md">
        <label class="form-label margin-bottom-xxxs" for="input-last-name">Last name</label>
        <input class="form-control width-100%" type="text" name="input-last-name" id="input-last-name">
      </div>
    </div>
  </div>

  <div class="margin-bottom-sm">
    <label class="form-label margin-bottom-xxxs" for="input-email">Email</label>
    <input class="form-control width-100%" type="email" name="input-email" id="input-email" placeholder="email@myemail.com">
  </div>

  <div class="margin-bottom-md">
    <label class="form-label margin-bottom-xxxs" for="input-password">Password</label> 
    <input class="form-control width-100%" type="password" name="input-password" id="input-password">
    <p class="text-xs color-contrast-medium margin-top-xxs">Minimum 6 characters</p>
  </div>

  <div class="margin-bottom-md">
    <input class="checkbox" type="checkbox" id="check-newsletter">
    <label for="check-newsletter">Send me updates about {productName}</label>
  </div>

  <div class="margin-bottom-sm">
    <button class="btn btn--primary btn--md width-100%">Join</button>
  </div>

  <div class="text-center">
    <p class="text-xs color-contrast-medium">By joining, you agree to our <a href="#0">Terms</a> and <a href="#0">Privacy Policy</a>.</p>
  </div>
</form>

    </div>
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
<!-- Signup Modal END-->
