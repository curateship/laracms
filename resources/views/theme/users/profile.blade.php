@extends('admin.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg padding-top-md">
  <div class="grid gap-md">

    <!-- User Informations -->
    <div class="col-4@md card padding-bottom-md">
        @include('components.users.user-bio-card')
    </div>

    <!-- Users Posts -->
    <div class="col-11@md">
    <h1 class="text-xl padding-bottom-md">{{$user->name}}'s Posts</h1>
    @include('components.users.lists.users-posts')
    </div>

  </div>
</div>

@endsection
