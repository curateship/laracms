@extends('themes.jpn.layouts.app')
@section('content')

<!-- Content Body Wrapper-->
<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">

    <!-- Post Lists -->
    <div class="col-12@md">
      @include('components.posts.lists.recent-posts-list')
    </div>

    <!-- Sidebar -->
    <div class="col-3@md">
      @include('components.ads.sidebar')
    </div>
    
  </div><!-- Grid END (col-12 and col-3) -->
</div><!-- Container Wrapper END -->
@endsection
