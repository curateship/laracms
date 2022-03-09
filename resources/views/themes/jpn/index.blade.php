@extends('themes.jpn.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Recent Post Lists Component -->
    <div class="col-12@md margin-bottom-md">
        @include('components.posts.lists.recent-posts-list')
    </div>

    <!-- Ads Sticky Sidebar Desktop Component -->
    <div class="col-3@md margin-top">
      <h3 class="padding-bottom-md color-contrast-high">Related Posts</h3>
        @include('components.posts.lists.related-posts-sidebar')
    </div>
    
  </div>
</div>
@endsection
