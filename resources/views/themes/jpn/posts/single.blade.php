@extends('themes.jpn.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
<div class="grid gap-md">

  <!-- Sticky Share Sidebar -->
  <div class="col-1@md display@md">
    @include('components.layouts.partials.sticky-sharebar')
  </div>
  <!-- Sticky Share Sidebar END -->
  
  <!-- Content Start -->
  <div class="col-11@md padding-x-lg@md">
    @include('components.posts.single.article-plain')
  <!-- Content END -->

  <div class="border-top margin-top-lg"></div>

  <!-- Comments -->
  <section class="comments padding-md">
    @include('components.comments.comments-v1')
  </section>
  <!-- END -->

</div>
 <!-- END -->

<!-- Sidebar -->
<div class="col-3@md">
  @include('components.posts.lists.related-posts-sidebar')
</div>
<!--Sidebar END -->

</div>
</div>

 @endsection
