@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-xs padding-lg card margin-top-lg">
  @include('components.auth.login')
</div>

@endsection
