<!-- Forgot Password Form Start 👇-->
<form action="{{ route('password.request') }}" method="POST">@csrf
<form class="password-reset-form">
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
    <p class="text-sm"><a href="{{ route('login') }}">&larr; Back to login</a></p>
  </div>
</form>
</form>
<!-- Forgot Password Form END-->