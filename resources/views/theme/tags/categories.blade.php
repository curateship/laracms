@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

  @foreach($categories as $category)
      <h1>{{$category->name}}</h1>
      @if(isset($tags[$category->id]))
        @include('components.tags.lists.tag-categories', ['tags' => $tags[$category->id]])
      @else
        No tags
      @endif
  @endforeach

  </div>
</div>
@endsection
