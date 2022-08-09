@extends(config('theme.main_app_template'))
@section('content')

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.search-results-hr')
</div>
       
<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection
