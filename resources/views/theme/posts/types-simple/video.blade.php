@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

@push('custom-scripts')
    @include('components.posts.comments.scripts-js')
    @include('components.posts.likes.scripts-js')
@endpush

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Sticky Interactions Sidebar -->
    <div class="col-1@md display@md">
      @include('components.layouts.partials.sticky-interactions')
    </div>

    <!-- Content -->
    <div class="col-11@md padding-x-lg@md">
      @include('components.posts.show.types.video')

    <!-- Author Box -->
    <div class="padding-y-lg">
    @include('components.users.show.author-box')
    </div>

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
