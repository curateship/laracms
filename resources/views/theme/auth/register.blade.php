@extends(config('theme.main_app_template'))
@section('content')

<div class="container max-width-xs card padding-lg">
  @include('components.auth.register')
</div>

@endsection
