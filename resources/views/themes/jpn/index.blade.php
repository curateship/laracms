@extends('themes.default.layouts.app')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">
          @include('components.posts.recent-posts-list')
      </div>
      <!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('components.ads.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
