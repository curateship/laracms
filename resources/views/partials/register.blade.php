@extends('apps.master')
@section('content')
<div class="container max-width-xs margin-top-xxl card padding-lg">
<!-- Register Form Start 👇-->
<form action="{{ route('register') }}" method="POST">
  @csrf
    <form class="sign-up-form padding-lg">
      <div class="text-component text-center margin-bottom-sm">
        <h1>Get started</h1>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. <br>
            Already have an account? <a href="#0">Login</a></p>
      </div>

  <div class="grid gap-xs">
    <div class="col-7@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path></g></svg>
        <span>Join using Twitter</span>
      </button>
    </div>
    
    <div class="col-8@xs">
      <button class="btn btn--subtle width-100%">
        <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 16 16"><g><path d="M15.3,0H0.7C0.3,0,0,0.3,0,0.7v14.7C0,15.7,0.3,16,0.7,16H8v-5H6V8h2V6c0-2.1,1.2-3,3-3 c0.9,0,1.8,0,2,0v3h-1c-0.6,0-1,0.4-1,1v1h2.6L13,11h-2v5h4.3c0.4,0,0.7-0.3,0.7-0.7V0.7C16,0.3,15.7,0,15.3,0z"></path></g></svg>
        <span>Join using Facebook</span>
      </button>
    </div>
  </div>

  <p class="text-center margin-y-sm">or</p>

  <div class="margin-bottom-sm">
    <div class="grid gap-xs">
 
        @error('name')
        <span class="form-control--error" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        <input class="form-control width-100%" type="text" name="name" id="name" placeholder="Enter Name">


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
    <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
  </div>

  <div class="margin-bottom-md">
    @error('password')
      <span class="form-control--error" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
    <input class="form-control width-100%" type="password" name="password_confirmation" id="input-password" placeholder="Enter Password Again">
    <p class="text-xs color-contrast-medium margin-top-xxs">Minimum 6 characters</p>
  </div>

  

  <div class="margin-bottom-sm">
    <button class="btn btn--primary btn--md width-100%">Join</button>
  </div>

  <div class="text-center">
    <p class="text-xs color-contrast-medium">By joining, you agree to our <a href="#0">Terms</a> and <a href="#0">Privacy Policy</a>.</p>
  </div>
</form>
</form>
<!-- Register Form END-->

</div>
@endsection