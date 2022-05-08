@extends('admin.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Col 4 -->
    <div class="col-4@md card padding-bottom-md">
        @include('components.users.user-bio-card')
    </div>

    <!-- Col 8 -->
    <div class="col-11@md">
    <h1 class="text-xl padding-bottom-md">{{$user->name}}'s Posts</h1>
    @include('components.users.users-posts')
    </div>

  </div>
</div>

@endsection
