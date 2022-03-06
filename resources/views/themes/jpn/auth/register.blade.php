@extends('themes.default.layouts.app')
@section('content')
<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl card padding-lg">

<!-- Register Form Content 👇-->
  @include('components.auth.register')
<!-- Register Form Content END -->

</div>
<!-- Register Form Wrapper END-->
@endsection
