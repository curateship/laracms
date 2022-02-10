<!-- Login Modal Start 👇-->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="modal-login">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">

  <!-- Login Form Start 👇-->
  <form action="{{ route('login') }}" class="modal-login" method="POST">
      @csrf
      <input type="hidden" name="target" value="modal-login">

      <div class="text-component text-center margin-bottom-sm">
        <h1>Log in</h1>
      </div>

      <div class="margin-bottom-sm">
          @if(old('target') == 'modal-login')
              @error('email')
              <span class="form-control--error" role="alert">
                {{ $message }}
              </span>
              @enderror
          @endif
        <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com">
      </div>

      <div class="margin-bottom-sm">
          @if(old('target') == 'modal-login')
              @error('password')
              <span class="form-control--error" role="alert">
                  {{ $message }}
                </span>
              @enderror
          @endif
        <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
        <span class="text-sm"><a href="{{ route('password.request') }}" aria-controls="modal-forgot-password">Forgot Your Password?</a></span>
      </div>

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Login</button>
      </div>

      <div class="text-center">
        <p class="text-sm">Don't have an account? <a href="{{ route('register') }}" aria-controls="modal-signup">Get started</a></p>
      </div>

</form>

<button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
<!-- Login Form END-->

</div>
</div>
<!-- Login Modal END-->

<!-- Signup Modal Start 👇-->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="modal-signup">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">
    <div class="max-width-xs margin-x-auto">

    <!-- Register Form Content 👇-->
<form action="{{ route('register') }}" class="sign-up-form padding-lg" method="POST">
    @csrf
    <input type="hidden" name="target" value="modal-signup">

    <div class="text-component text-center margin-bottom-sm">
      <h1>Get started</h1>
        <p>Already have an account? <a href="{{ route('login') }}" aria-controls="modal-login">Login</a></p>
    </div>

    <div class="padding-bottom-sm">
        @if(old('target') == 'modal-signup')
            @error('name')
            <span class="form-control--error" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
        @endif
      <input class="form-control width-100%" type="text" name="name" id="name" placeholder="Enter Name">
    </div>

    <div class="margin-bottom-sm">
        @if(old('target') == 'modal-signup')
            @error('email')
            <span class="form-control--error" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
        @endif
      <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com">
    </div>

    <div class="margin-bottom-sm">
        @if(old('target') == 'modal-signup')
            @error('password')
            <span class="form-control--error" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
        @endif
      <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
    </div>

    <div class="margin-bottom-md">
        @if(old('target') == 'modal-signup')
            @error('password')
            <span class="form-control--error" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
        @endif
      <input class="form-control width-100%" type="password" name="password_confirmation" id="input-password" placeholder="Enter Password Again">
      <p class="text-xs color-contrast-medium margin-top-xxs">Minimum 8 characters</p>
    </div>

    <div class="margin-bottom-sm">
      <button class="btn btn--primary btn--md width-100%">Join</button>
    </div>

    <div class="text-center">
      <p class="text-xs color-contrast-medium">By joining, you agree to our <a href="#0">Terms</a> and <a href="#0">Privacy Policy</a>.</p>
    </div>
</form>
<!-- Register Form Content END -->

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

<!-- Forgot Password Modal Start 👇-->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="modal-forgot-password">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">

  <!-- Forgot Password Form Start 👇-->
<form action="{{ route('password.request') }}" class="password-reset-form" method="POST">@csrf
  <div class="text-component text-center margin-bottom-md">
    <h1>Forgot your password?</h1>
    <p>Enter your Email below</p>
    @if(session('status'))
      <div class="alert alert--success">
        {{ session ('status') }}
      </div>
    @endif
  </div>

  <div class="margin-bottom-sm">
        @error('email')
        <span class="form-control--error" role="alert">
          {{ $message }}
        </span>
        @enderror
        <input class="form-control width-100%" name="email" id="password" placeholder="Input Email you registered with">
      </div>

  <div class="margin-bottom-sm">
    <button class="btn btn--primary btn--md width-100%">Request reset link</button>
  </div>

  <div class="text-center">
    <p class="text-sm"><a href="{{ route('login') }}" aria-controls="modal-login">&larr; Back to login</a></p>
  </div>
</form>
<!-- Forgot Password Form END-->

</div>
</div>
<!-- Forgot Password Modal END-->
