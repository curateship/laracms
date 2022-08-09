@extends(config('theme.main_app_template'))
@section('content')

<div class="container max-width-xs padding-lg card margin-top-lg">
  @include('components.auth.login')
</div>

@endsection
