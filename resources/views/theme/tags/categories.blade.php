@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Tag Category -->
    <h1>{{$category->name}}</h1>
      @if(count($tags) > 0)
          @include('components.tags.lists.tag-categories', ['tags' => $tags])
      @else
          No tags
      @endif

    <!-- Pagination -->
    <div class="padding-top-md">
      @include('components.layouts.partials.pagination', ['items' => $tags])
    </div>  

    </div>
</div>
@endsection
