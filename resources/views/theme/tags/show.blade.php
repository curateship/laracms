@extends(config('theme.main_app_template'))
@section('content')

<!-- Tag Informations -->
@include('components.tags.show.tag-informations')

<!-- Post list -->
<div class="margin-bottom-lg">
  @include('components.tags.lists.show-posts-simple')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
  @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection