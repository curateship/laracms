@extends(config('theme.main_app_template'))
@section('content')
<div class="padding-lg">

    <!-- Tag Informations -->
    <h1 class="text-xl padding-bottom-lg">{{ $tag->name }}</h1>

    <!-- Post list -->
    <div class="margin-bottom-lg">
      @include('components.tags.lists.show-posts-simple-v2')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>

</div>
@endsection