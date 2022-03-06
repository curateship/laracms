@extends('themes.default.layouts.app')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">
    @include('components.posts.single.single-v2')

  <!-- Comments -->
  <section class="container comments padding-md max-width-md">
    @include('components.comments.comments-v1')
  </section>
  <!-- END -->

  </div>
 <!-- END -->

 @endsection
