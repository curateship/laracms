@extends('themes.default.layouts.app')
@section('content')

<!-- Confirm Password Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Confirm Password Form Start 👇-->
  @include('components.auth.confirm-password')
<!-- Confirm Password Form END-->

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
