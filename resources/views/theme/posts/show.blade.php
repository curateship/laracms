@extends('theme.layouts.app')
@section('content')

@push('custom-scripts')
    @include('components.posts.comments.scripts-js')
    @include('components.posts.likes.scripts-js')
@endpush

<div class="container max-width-adaptive-lg">
  <div class="grid gap-sm">

    <!-- Content -->
    <div class="col-12@md padding-right-lg@md">
      @include('components.posts.single.article-plain')

    <!-- Comments -->
    <div class="border-top margin-top-sm"></div>
      <section class="comments margin-top-md">
        @include('components.comments.list')
      </section>
    </div>

    <!-- Sidebar -->
    <div class="col-3@md">
      <h3 class="padding-bottom-sm color-contrast-high">Related Posts</h3>
      @include('components.posts.lists.filtered-posts.related-posts-sidebar')
    </div>

  </div>
</div>

 @endsection
