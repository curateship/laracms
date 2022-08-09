@extends(config('theme.main_app_template'))
@section('content')

    <!-- Advance Search -->
    <div class="margin-bottom-lg">
      @include('components.layouts.partials.advance-search')
    </div>

    <!-- Recent Posts -->
    <div class="margin-bottom-xl">
      @include(config('theme.content_grid'))
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

@endsection
