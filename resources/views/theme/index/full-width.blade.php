@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">

    <!-- Popular Tags -->
    <div class="padding-y-sm">
      @include('components.tags.lists.popular-tags')
    </div>

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include('components.posts.lists.recent-posts.recent-posts-grid')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <!-- Site Discription -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.homepage-site-description')
    </div>

</div>
@endsection