@extends('themes.default.layouts.app')
@section('content')

<!-- Register Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl padding-lg card">

<!-- Login Form Start 👇-->
 @include('components.auth.two-factor-challenge')
<!-- Login Form END-->

</div>
<!-- Register Form Wrapper END-->

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
