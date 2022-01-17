@extends('apps.master')
@section('content')
<div class="container max-width-xs margin-top-xxl padding-lg card">
<!-- Login Form Start 👇-->
<form action="{{ route('login') }}" method="POST">
@csrf
<form class="login-form">
  <div class="text-component text-center margin-bottom-sm">
    <h1>Log in</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
  </div>

  <div class="grid gap-xs">
    <div class="col-7@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path></g></svg>
        <span>Login with Twitter</span>
      </button>
    </div>
    
    <div class="col-8@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M16,8.048a8,8,0,1,0-9.25,7.9V10.36H4.719V8.048H6.75V6.285A2.822,2.822,0,0,1,9.771,3.173a12.2,12.2,0,0,1,1.791.156V5.3H10.554a1.155,1.155,0,0,0-1.3,1.25v1.5h2.219l-.355,2.312H9.25v5.591A8,8,0,0,0,16,8.048Z"></path></g></svg>
        <span>Login with Facebook</span>
      </button>
    </div>
  </div>

  <p class="text-center margin-y-sm">or</p>

  <div class="margin-bottom-sm">
    @error('email')
      <span class="form-control--error" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
    <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com">
  </div>

  <div class="margin-bottom-sm">
    @error('password')
      <span class="form-control--error" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
    <div class="flex justify-between margin-bottom-xxxs">
    </div>
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
@endsection