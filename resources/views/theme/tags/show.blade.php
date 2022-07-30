@extends('theme.layouts.app')
@section('content')
<div class="padding-md padding-lg@md">

    <!-- Tag Informations -->
    <h1 class="text-xl padding-bottom-lg">{{ $tag->name }}</h1>

    <!-- Post list -->
    <div class="margin-bottom-lg">
      @include('components.tags.lists.show-posts-simple-hr')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>

</div>
@endsection
