@extends('theme.layouts.app')
@section('content')
@include('components.layouts.partials.hero-random-image')

<!-- Content Body Component -->
<div class="container max-width-lg grid gap-md">
  @include('components.posts.single.article-plain')
</div>

<!-- Comment Component -->
<div class="container comments max-width-md margin-top-xl">
  @include('components.comments.comments-v1')
</div>

 @endsection
