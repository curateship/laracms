@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="grid gap-md">

  <!-- Content -->
  <div class="">
    @include('components.posts.show.types.image')
  </div>

@endsection
