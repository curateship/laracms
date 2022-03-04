@extends('apps.master')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

        @if (! auth()->user()->two_factor_secret)
          You have not enable 2fa
          <form method="POST" action="{{ url('user/two-factor-authentication') }}">@csrf
            <button type="submit" class="btn btn-primary">
              Enable
            </button>
          </form>
        @else
            You have 2fa enabled
            <form method="POST" action="{{ url('user/two-factor-authentication') }}">
              @csrf
              @method('DELETE')
            <button type="submit" class="btn btn-primary">
              Disable
            </button>
            </form>
        @endif

        @if(session('status') == 'two-factor-authentication-enabled')
          <p> You have now enabled 2fa, please scan the following QR code into your phone authenticator application.</p>
          {!! auth()->user()->twoFactorQrCodeSvg() !!}
          <p>Please store these recovery codes in a secure location</p>

        @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
          {{ trim($code) }} <br>
        @endforeach

        @endif
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
