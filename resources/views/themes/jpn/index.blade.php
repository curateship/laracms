@extends('themes.jpn.layouts.app')
@section('content')
@include('components.layouts.partials.hero-random-image')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">

    <!-- Recent Post Lists Component -->
    <div class="col-12@md z-index-1">
      @include('components.posts.lists.recent-posts-list')
    </div>

    <!-- Ads Sticky Sidebar Desktop Component -->
    <div class="col-3@md">
      @include('components.posts.lists.related-posts-sidebar')
    </div>
    
  </div>
</div>
@endsection
