@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.search-results-simple')
</div>
       
<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection
