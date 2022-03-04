<!-- Login Form Start 👇-->
  <form action="{{ url('/two-factor-challenge') }}" method="POST">
      @csrf
      <div class="text-component text-center margin-bottom-sm">
        <h1>2fa login</h1>
      </div>

      <div class="margin-bottom-sm">
          @if(session('status'))
              <div class="alert alert-success" role="alert">{{session('status')}}</div>
          @endif
      </div>

      <input type="text" name="code" class="form-control width-100%">

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Login</button>
      </div>
</form>
<!-- Login Form END-->
