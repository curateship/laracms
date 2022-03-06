@extends('themes.default.layouts.app')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

        <!-- 👇 Recent Post -->
          <div class="justify-between flex items-end justify-between@md margin-bottom-md hide@md">
            <h3>Recent Post</h3>
            <div class="justify-between flex items-end justify-between@md">
            <a href="http://localhost:8000/post" class="btn btn--primary btn--sm radius-full margin-right-xs" role="text">My Feed</a> 
            <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full margin-right-xs" role="text">Popular</a> 
            <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">New</a> 
            </div>
          </div>
          @include('components.posts.recentposts')
          <!-- Recent Post END -->

      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
      @include('components.layouts.sidebars.sidebar-filter')
        @include('components.layouts.sidebars.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
