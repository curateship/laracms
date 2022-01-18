@extends('apps.master')
@section('content')

<!-- Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Forgot Password Form Start 👇-->
<form class="password-reset-form">
  <div class="text-component text-center margin-bottom-md">
    <h1>Forgot your password?</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
  </div>

  <div class="margin-bottom-sm">
    <label class="form-label margin-bottom-xxxs" for="input-email">Email</label>
    <input class="form-control width-100%" type="email" name="input-email" id="input-email" placeholder="email@myemail.com">
  </div>

  <div class="margin-bottom-sm">
    <button class="btn btn--primary btn--md width-100%">Request reset link</button>
  </div>

  <div class="text-center">
    <p class="text-sm"><a href="#0">&larr; Back to login</a></p>
  </div>
</form>
<!-- Forgot Password Form END-->

</div>
<!-- Wrapper END-->
@endsection