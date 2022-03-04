<!-- Login Form Start 👇-->
  <form action="{{url('user/confirm-password')}}" method="POST">@csrf
    <form class="login-form">
      <div class="text-component text-center margin-bottom-sm">
        <h1>Confirm Your Password</h1>
      </div>

      <div class="margin-bottom-sm">
        @error('password')
        <span class="form-control--error" role="alert">
          {{ $message }}
        </span>
        @enderror
        <input class="form-control width-100%" type="password" name="password" id="input-password" placeholder="Input Password">
      </div>

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Enable</button>
      </div>

  </form>
</form>
<!-- Login Form END-->
