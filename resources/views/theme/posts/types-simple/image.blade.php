@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Content -->
    <div class="padding-x-lg@md">
      @include('components.posts.show.types.image')

  </div>
</div>

@endsection
