@extends('theme.layouts.app')
@section('content')

<div class="padding-md padding-lg@md">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include('components.posts.lists.recent-posts.recent-posts-grid-hr')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-xl">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <!-- Popular Tags -->
    <h1 class="padding-bottom-sm">Popular Tags</h1>
    <div class="padding-y-md">
      @include('components.tags.lists.popular-tags')
    </div>

    <!-- Site Discription -->
    <div class="padding-y-md">
        @include('components.layouts.partials.homepage-site-description')

    </div>

</div>
@endsection