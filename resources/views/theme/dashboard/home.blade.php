@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">
    <div class="col-12@md">

      <!-- Mobile Navigation Buttons -->
      <div class="justify-between flex items-end justify-between@md margin-bottom-md hide@md">
        <div class="justify-between flex items-end justify-between@md">
          <a href="http://localhost:8000/post" class="btn btn--primary btn--sm radius-full margin-right-xs" role="text">My Feed</a>
          <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full margin-right-xs" role="text">Popular</a>
          <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">New</a>
        </div>
      </div>

      <!-- Recent Post List Component -->
      @include('components.posts.lists.recent-posts-list')
      </div><!-- Col-12 END -->

    <!-- Sidebar -->
    <div class="col-3@md">
    @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
            @include('admin.partials.sidebar-admin')
        @else
            @include('admin.partials.sidebar')
        @endif
    </div>

  </div>
</div>

@endsection
