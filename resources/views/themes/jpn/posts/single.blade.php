@extends('themes.jpn.layouts.app')
@section('content')

<!-- Container -->
<div class="container max-width-lg grid gap-md">
  @include('components.posts.single.single-v2')

<!-- Comments -->
<section class="container comments max-width-md margin-top-xl">
  @include('components.comments.comments-v1')
</section>

</div>
<!-- END -->
 @endsection
