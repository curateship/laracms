@extends('themes.jpn.layouts.app')
@section('content')

<!-- Content Body Component -->
<div class="container max-width-lg grid gap-md">
  @include('components.posts.single.article-plain')
</div>

<!-- Comment Component -->
<section class="container comments max-width-md margin-top-xl">
  @include('components.comments.comments-v1')
</section>

 @endsection
