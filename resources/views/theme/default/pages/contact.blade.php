@extends('theme.default.layouts.app')
@section('content')
<!-- Contact Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl card padding-lg">

<!-- Contact Form Content 👇-->
<form action="{{ route('contact.store') }}" method="POST">@csrf
  <form class="sign-up-form padding-lg">

    <div class="text-component text-center margin-bottom-sm">
      <h1>Contact Us</h1>
    </div>

    <div class="padding-bottom-sm">
      @error('name')
      <span class="form-control--error" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input class="form-control width-100%" type="text" name="name" id="name" placeholder="Enter Name">
    </div>

    <div class="margin-bottom-sm">
      @error('email')
      <span class="form-control--error" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com">
    </div>

    <div class="padding-bottom-sm">
      @error('name')
      <span class="form-control--error" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input class="form-control width-100%" type="text" name="subject" id="subject" placeholder="Enter your subject">
    </div>

    <div class="form-validate__input-wrapper js-form-validate__input-wrapper">
      <textarea class="form-control width-100%" name="textarea" id="textarea" minlength="20" required placeholder="Enter Your Messages"></textarea>
      <div role="alert" class="form-validate__error-msg bg-error bg-opacity-20% padding-x-xs padding-y-xxs radius-md text-xs color-contrast-higher margin-top-xxs"><p>Must be at least 10 characters.</div>
      <p class="text-xs color-contrast-medium margin-top-xxs">At least 10 characters.</p>
    </div>


    <div class="margin-bottom-sm margin-top-md">
      <button class="btn btn--primary btn--md width-25%">Submit</button>
    </div>

  </form>
</form>
<!-- Contact Form Content END -->

</div>
<!-- Contact Form Wrapper END-->
@endsection
