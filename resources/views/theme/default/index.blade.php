@extends('theme.default.layouts.app')
@section('content')
@include('auth.modals')
@include('theme.default.partials.hero')
<div class="container max-width-lg">

  <!-- 👇 Recommended -->
  <div class="justify-between flex items-end justify-between@md margin-bottom-lg">
    <h4>Rocommended</h4>
    <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">View all</a>
  </div>
  @include('theme.default.posts.partials.recent-post-index')
  <!-- Recommended END -->

  <!-- 👇 Recommended -->
  <div class="justify-between flex items-end justify-between@md">
    <h4>Rocommended Tags</h4>
    <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">View all</a>
  </div>
  @include('partials.recommended-tags')
    <!-- Recommended END -->

    <!-- 👇 Recommended -->
  <div class="justify-between flex items-end justify-between@md margin-bottom-lg">
    <h4>Rocommended Artist</h4>
    <a href="http://localhost:8000/post" class="btn btn--subtle btn--sm radius-full" role="text">View all</a>
  </div>
  @include('partials.recommended-users-v2')
    <!-- Recommended END -->

</div>

<!-- 👇 Back to Top -->
<a class="back-to-top js-back-to-top" href="#" data-offset="100" data-duration="300">
    <svg class="icon" viewBox="0 0 20 20"><polyline points="2 13 10 5 18 13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
  </a>
  <!-- Back to Top END -->
@endsection
