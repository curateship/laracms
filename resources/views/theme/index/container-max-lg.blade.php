@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-adaptive-lg">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include('components.posts.lists.recent-posts.recent-posts-grid')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-xl">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <!-- Popular Tags -->
    <div class="padding-bottom-xl">
      <h1 class="padding-bottom-sm">Popular {{$popular_tags_category_name}}</h1>
        @include('components.tags.lists.popular-tags')
    </div>

    <!-- Popular Posts -->
    <div class="padding-bottom-xl">
    <h1 class="padding-bottom-md">Popular Posts</h1>
      @include('components.posts.lists.filtered-posts.popular-posts')
    </div>

    <!-- Site Discription -->
    <div class="padding-y-md">
        @include('components.layouts.partials.homepage-site-description')
    </div>

</div>
@endsection
