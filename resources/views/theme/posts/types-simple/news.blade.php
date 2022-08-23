@extends(config('theme.main_app_template'))
@section('content')

<div class="grid gap-md">

  <!-- Content -->
  <div class="">
    @include('components.posts.show.types.no-image')
  </div>

@endsection
