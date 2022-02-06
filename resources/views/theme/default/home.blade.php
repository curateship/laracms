@extends('theme.default.layouts.app')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

      <div class="padding-bottom-lg">
          @include('theme.default.partials.carousel')
          </div>

        <!-- 👇 Recent Post -->
          <div class="justify-between flex items-end justify-between@md margin-bottom-md">
            <h3>Recent Post</h3>
            <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">View all</a>
          </div>
          @include('theme.default.partials.recent-post')
          <!-- Recent Post END -->

      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('theme.default.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
