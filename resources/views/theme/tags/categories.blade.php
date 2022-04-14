@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

  <h1>Category</h1>
    @include('components.tags.lists.tag-categories')

  </div>
</div>
@endsection
