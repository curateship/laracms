@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">

    <!-- Tag Informations -->
    <div class="margin-bottom-lg">
      @include('components.tags.tag-informations')
    </div>

    <!-- Post list -->
    <div class="margin-bottom-lg">
      @include('components.tags.lists.show-posts')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>

</div>
@endsection
