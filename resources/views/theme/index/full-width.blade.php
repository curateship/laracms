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
</div>
@endsection
