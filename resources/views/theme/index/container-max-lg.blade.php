@extends(config('theme.main_app_template'))
@section('content')

    <!-- Diagonal Hero -->
    @if (Auth::guest())
      <div class="margin-bottom-xs">
        {!! env('DIAGONAL_HERO') !!}
      </div>
    @endif

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
