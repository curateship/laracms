@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-xs padding-lg card">
  @include('components.auth.verify-email')
</div>

@endsection