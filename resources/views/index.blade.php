@extends('apps.master')
@section('content')
@include('partials.hero')
<div class="container max-width-lg padding-y-lg ">
  @include('partials.recommended-traders')
  @include('partials.recommended-tags')
</div>
@endsection