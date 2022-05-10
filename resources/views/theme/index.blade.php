@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Recent Post Lists Component -->
    <div class="col-12@md margin-bottom-sm">
        @if($theme == 'classic')
            @include('components.posts.lists.specific-tag-posts')
        @else
            @include('components.posts.lists.masonry-infinite')
        @endif
    </div>

    <!-- Popular Posts -->
    <div class="col-3@md">
    <h3 class="padding-bottom-md color-contrast-high">Popular {{$popular_tags_category_name}}</h3>
      @include('components.tags.lists.popular-tags')

    <h3 class="padding-bottom-md color-contrast-high">Popular Posts</h3>
      @include('components.posts.lists.popular-posts-sidebar')
    </div>

  </div>
</div>
@endsection
