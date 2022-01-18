@extends('apps.master')
@section('content')

<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Login Form Start 👇-->
  <form action="{{ route('login') }}" method="POST">@csrf
    <form class="login-form">
      <div class="text-component text-center margin-bottom-sm">
        <h1>Log in</h1>
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
        <span class="text-sm"><a href="#0">Forgot Your Password?</a></span>
      </div>

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Login</button>
      </div>

      <div class="text-center">
        <p class="text-sm">Don't have an account? <a href="#0">Get started</a></p>
      </div>
  </form>
</form>
<!-- Login Form END-->

</div>
<!-- Register Form Wrapper END-->
@endsection