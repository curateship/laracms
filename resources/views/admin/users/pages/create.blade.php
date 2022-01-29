@extends('apps.master')
@section('content')
<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl card padding-lg">

<!-- Register Form Content 👇-->
<form action="{{ route('admin.users.create') }}" method="POST">@csrf
  <form class="sign-up-form padding-lg">
    
    <div class="text-component text-center margin-bottom-sm">
      <h1>Create New User</h1>
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

    <div class="margin-bottom-sm">
      @error('password')
      <span class="form-control--error" role="alert">
      <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
    </div>

    <div class="margin-bottom-sm">
      <button class="btn btn--primary btn--md width-100%">Join</button>
    </div>

  </form>
</form>
<!-- Register Form Content END -->

</div>
<!-- Register Form Wrapper END-->
@endsection
