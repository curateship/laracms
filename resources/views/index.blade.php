@extends('apps.master')

@section('content')
@include('auth.modals')
@include('partials.hero')
<div class="container max-width-lg">
  @include('partials.recommended-traders')
  @include('partials.recommended-tags')
</div>

<!-- 👇 Back to Top -->
<a class="back-to-top js-back-to-top" href="#" data-offset="100" data-duration="300">
    <svg class="icon" viewBox="0 0 20 20"><polyline points="2 13 10 5 18 13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
  </a>
  <!-- Back to Top END -->
@endsection
