@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">

    <!-- Recent Posts -->
    <div class="margin-bottom-sm">
    @include('components.posts.lists.infinite-masonry.list')
    </div>

</div>
@endsection
