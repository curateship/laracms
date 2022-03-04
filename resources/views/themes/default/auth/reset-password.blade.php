@extends('themes.default.layouts.app')
@section('content')

<!-- Reset Password Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Reset Password Form Start 👇-->
  @include('components.auth.reset-password')
<!-- Reset Password Form END-->

</div>
<!-- Reset Password Form Wrapper END-->
@endsection
