@extends('themes.default.layouts.app')
@section('content')

<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Login Form Start 👇-->
  @include('components.auth.login')
<!-- Login Form END-->

</div>
<!-- Register Form Wrapper END-->
@endsection
