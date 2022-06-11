@extends('theme.layouts.app')
@section('content')

<!-- Container -->
<div class="container max-width-adaptive-lg padding-top-sm">

<div class="text-component padding-bottom-md">
    <h1 class="text-xl">Most viewed posts</h1>
</div>

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.most-viewed')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

</div>
@endsection
