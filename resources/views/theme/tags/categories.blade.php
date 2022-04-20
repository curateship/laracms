@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

      <h1>{{$category->name}}</h1>
      @if(count($tags) > 0)
          @include('components.tags.lists.tag-categories', ['tags' => $tags])
      @else
          No tags
      @endif

  </div>

    <div>
        @include('components.layouts.partials.pagination', ['items' => $tags])
    </div>
</div>
@endsection
