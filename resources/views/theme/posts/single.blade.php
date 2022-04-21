@extends('theme.layouts.app')
@section('content')

@push('custom-scripts')
    @include('components.posts.comments.scripts-js')
@endpush

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Sticky Share Sidebar -->
    <div class="col-1@md display@md">
      @include('components.layouts.partials.sticky-sharebar')
    </div>

    <!-- Content -->
    <div class="col-11@md padding-x-lg@md">
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
        @include('components.posts.lists.related-posts-sidebar')
    </div>

  </div>
</div>

 @endsection
