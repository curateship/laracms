@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-xs padding-lg card">
 @include('components.auth.two-factor-challenge')
</div>

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
