@extends(config('theme.main_app_template'))

@push('custom-scripts')
    @include('theme.posts.most-posts-scripts')
@endpush

@section('content')

<div class="flex flex-column text-component padding-bottom-md gap-xs flex-row@md justify-between@md items-center@md">
    <h1 class="text-xl">Premium posts</h1>
</div>

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.premium')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection
