@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Recent Post Lists Component -->
    <div class="col-12@md margin-bottom-sm">
    <h3 class="padding-bottom-md color-contrast-high">Featured</h3>
        @include('components.posts.lists.specific-tag-posts')
    <h3 class="padding-bottom-md color-contrast-high">New</h3>
        @include('components.posts.lists.recent-posts-list')
    </div>

    <!-- Popular Posts -->
    <div class="col-3@md">
    <h3 class="padding-bottom-md color-contrast-high">Popular Origins</h3>
      @include('components.tags.lists.popular-tags')

    <h3 class="padding-bottom-md color-contrast-high">Popular Posts</h3>
      @include('components.posts.lists.popular-posts-sidebar')
    </div>

  </div>
</div>
@endsection
