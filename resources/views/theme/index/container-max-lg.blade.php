@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="container max-width-adaptive-lg">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include(env('CONTENT_GRID'))
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

    <!-- Site Discription -->
    <div class="">
        {!! env('SITE_DISCRIPTION') !!}
    </div>

</div>
@endsection
