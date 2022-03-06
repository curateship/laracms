@extends('themes.default.layouts.app')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">

  <!-- Sticky Share Sidebar -->
  <div class="col-1@md display@md">
    @include('components.layouts.partials.sticky-sharebar')
  </div>
  <!-- Sticky Share Sidebar END -->

  <!-- Content Start -->
  <div class="col-11@md">
    <div class="card">
    @include('components.posts.single.single-v1')
    </div>
  </div>
  <!-- Content END -->

  <div class="border-top"></div>

  <!-- Comments -->
  <section class="comments padding-md">
    @include('components.comments.comments-v1')
  </section>
  <!-- END -->

  </div>
</div>
 <!-- END -->

<!-- Sidebar -->
<div class="col-3@md">
  @include('components.ads.sidebar')
</div>
<!--Sidebar END -->

</div>
 @endsection
