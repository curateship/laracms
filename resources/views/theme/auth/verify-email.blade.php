@extends(config('theme.main_app_template'))
@section('content')

<div class="container max-width-xs padding-lg card">
  @include('components.auth.verify-email')
</div>

@endsection