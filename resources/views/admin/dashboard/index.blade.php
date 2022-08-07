@extends(env('MAIN_APP_TEMPLATE'))
@section('content')
<div class="grid gap-md justify-between">

  <!-- Col 4 -->
  <div class="col-4@md card">
    <p class="padding-sm">Latest Feeds</p>
    @include('components.layouts.partials.notifications')
  </div>

  <!-- Col 8 -->
  <div class="col-8@md">
      @include('components.posts.lists.infinite-posts.list')
  </div>
  
  <!-- Col 3 -->
  <div class="col-3@md">
      @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
          @include('admin.partials.sidebar-admin')
      @else
          @include('admin.partials.sidebar')
      @endif
  </div>
</div>

@endsection
