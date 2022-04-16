@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Recent Post Lists Component -->
    <div class="col-12@md margin-bottom-sm">
        @include('components.posts.lists.recent-posts-list')
    </div>

    <div class="col-3@md">
      
      <!-- Our Friends -->
      <div class="card padding-sm">
        <h3 class="color-contrast-high text-md padding-bottom-xs">Our Friends</h3>
        {!! Menu::get('link-exchange')->asUl() !!}
      </div>

      <!-- Popular Posts -->
      <h3 class="padding-top-md padding-bottom-md color-contrast-high">Popular Posts</h3>
        @include('components.posts.lists.related-posts-sidebar')
    </div>

  </div>
</div>
@endsection
