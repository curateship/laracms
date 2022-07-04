@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">
      <h3>{{$gallery->title}}</h3>
      <div>{!! $gallery->body() !!}</div>
      <div>
          <img alt="gallery-image" src="/storage{{config('images.galleries_storage_path').$gallery->thumbnail}}">
      </div>

      @foreach($posts as $post)
          <img alt="gallery-post-image" src="/storage{{config('images.posts_storage_path').$post->thumbnail}}">
      @endforeach
  </div>
</div>

@endsection

