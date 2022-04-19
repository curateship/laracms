@extends('theme.layouts.app')
@section('content')
<div class="container max-width-lg grid gap-xl">

    <!-- User Bio -->
    @include('components.users.user-bio')

    <!-- User's Posts -->
    <div class="container max-width-adaptive-lg">

    <!-- Posts -->
    <div class="padding-bottom-md">
        <h1 class="text-xl padding-bottom-md">{{$user->name}}'s Posts</h1>
        @include('components.users.users-posts')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>

    </div>
<!-- END -->
 @endsection
