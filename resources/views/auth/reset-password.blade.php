@extends('apps.master')
@section('content')

<!-- Reset Password Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Reset Password Form Start 👇-->
<form method="POST" action="{{ route('password.update') }}">@csrf
  <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <form class="password-reset-form">
      <div class="text-component text-center margin-bottom-md">
        <h1>Reset Password</h1>
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
        <input class="form-control width-100%" type="password" name="email" id="password" placeholder="Input Email" value="{{ $request->email }}">
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
    <button class="btn btn--primary btn--md width-100%">Update</button>
  </div>

  <div class="text-center">
    <p class="text-sm"><a href="/login">&larr; Back to login</a></p>
  </div>
</form>
</form>
<!-- Reset Password Form END-->

</div>
<!-- Reset Password Form Wrapper END-->
@endsection