@extends('theme.layouts.app')
@section('content')

<!-- Container -->
<div class="padding-md padding-lg@md">

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.search-results-hr')
</div>
       
<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

</div>


@endsection
