@extends('theme.layouts.app')
@section('content')

<!-- Container -->
<div class="container max-width-adaptive-lg padding-top-sm">

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.search-results')
</div>
       
<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

</div>
@endsection
