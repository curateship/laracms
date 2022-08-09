@extends(config('theme.main_app_template'))
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
