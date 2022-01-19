@extends('apps.master')
@section('content')

<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Login Form Start 👇-->
  <form action="{{ route('verification.send') }}" method="POST">@csrf
    <form class="login-form">
      <div class="text-component text-center margin-bottom-sm">
        @if(session('status'))
        <div class="alert alert--success">
        {{ session ('status') }}
        </div>
        @endif
        <h1>Verify Email</h1>
        <p>You must check your email. Please check your email for a verification link.</p>
      </div>

      <div class="margin-bottom-sm margin-top-md">
        <button class="btn btn--primary btn--md width-100%">Resend Email</button>
      </div>

  </form>
</form>
<!-- Login Form END-->

</div>
<!-- Register Form Wrapper END-->
@endsection