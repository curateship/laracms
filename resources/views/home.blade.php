@extends('apps.master')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

        <!-- 👇 Recent Post -->
          <div class="justify-between flex items-end justify-between@md margin-bottom-lg">
            <h4>Recent Post</h4>
            <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">View all</a>
          </div>
          @include('partials.recent-post')
          <!-- Recent Post END -->

      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
