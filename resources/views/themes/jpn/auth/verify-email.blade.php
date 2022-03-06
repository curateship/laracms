@extends('themes.default.layouts.app')
@section('content')

<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Verify Email Form Start 👇-->
  @include('components.auth.verify-email')
<!-- Verify Email Form END-->

</div>
<!-- Register Form Wrapper END-->
@endsection