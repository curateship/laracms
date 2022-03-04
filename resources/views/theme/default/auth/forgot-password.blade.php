@extends('theme.default.layouts.app')
@section('content')

<!-- Forgot Password Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Forgot Password Form Start 👇-->
  @include('components.auth.forgot-password')
<!-- Forgot Password Form END-->

</div>
<!-- Forgot Password Form Wrapper END-->
@endsection