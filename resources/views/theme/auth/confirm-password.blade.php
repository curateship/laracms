@extends('theme.layouts.app')
@section('content')

<!-- Confirm Password Form Wrapper Start -->
<div class="container max-width-xs padding-lg card">

<!-- Confirm Password Form Start -->
  @include('components.auth.confirm-password')

</div>
<!-- Confirm Password Form Wrapper END-->

@parent
@if($errors->has('email') || $errors->has('password'))
    <script>
    $(function() {
        $('modal-login').modal({
            show: true
        });
    });
    </script>
@endif

@endsection
