@extends(config('theme.main_app_template'))
@section('content')

<!-- Tag Informations -->
@include('components.tags.show.tag-informations')

@if(count($char_tags_result) > 0)
    <div class="justify-start flex items-end margin-bottom-sm">
        <a href="/tags/{{$category->name}}/{{$tag->slug}}" class="btn {{request()->get('characters') == '' ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs">All</a>
    @foreach($char_tags_result as $char_tag)
        <a href="/tags/{{$category->name}}/{{$tag->slug}}?characters={{$char_tag['slug']}}" class="btn {{request()->get('characters') == $char_tag['slug'] ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs">{{$char_tag['name']}}</a>
    @endforeach
    </div>
@endif
<!-- -->

<!-- Post list -->
<div class="margin-bottom-lg">
  @include('components.tags.lists.show-posts-simple')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
  @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

@endsection
