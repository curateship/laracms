@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-xs card padding-lg">
  @include('components.auth.register')
</div>

@endsection
