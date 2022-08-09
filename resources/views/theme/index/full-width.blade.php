@extends(config('theme.main_app_template'))
@section('content')

<div class="padding-md">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include(config('theme.content_grid'))
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-xl">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <!-- Site Discription -->
    <div class="padding-y-md">
        {!! env('SITE_DISCRIPTION') !!}
    </div>

</div>
@endsection
