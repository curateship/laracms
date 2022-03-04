<!-- Login Form Start 👇-->
  <form action="{{ route('login') }}" method="POST" class="login-form">
      @csrf
      <div class="text-component text-center margin-bottom-sm">
        <h1>Log in</h1>

        <div class="text-center">
        <p>Don't have an account? <a href="/register">Get started</a></p>
      </div>

      </div>

      <div class="margin-bottom-sm">
        @error('email')
          <span class="form-control--error" role="alert">
            {{ $message }}
          </span>
        @enderror
        <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com">
      </div>

      <div class="margin-bottom-sm">
        @error('password')
        <span class="form-control--error" role="alert">
          {{ $message }}
        </span>
        @enderror
        <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
        <span class="text-sm"><a href="{{ route('password.request') }}">Forgot Your Password?</a></span>
      </div>

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Login</button>
      </div>

</form>
<!-- Login Form END-->
