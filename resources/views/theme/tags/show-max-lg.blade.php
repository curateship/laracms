@extends(config('theme.main_app_template'))
@section('content')

<!-- Tag Informations -->
<div class="margin-bottom-md">
@include('components.tags.show.tag-informations')
</div>

<!-- Post list -->
<div class="margin-bottom-lg">
  @include('components.tags.lists.show-posts-simple')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
  @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection