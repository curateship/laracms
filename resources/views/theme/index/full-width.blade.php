@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="padding-md">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include(env('CONTENT_GRID'))
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
