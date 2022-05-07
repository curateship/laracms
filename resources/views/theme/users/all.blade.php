@extends('theme.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md">

    <!-- Popular Posts -->
    <h1>Users</h1>
        @include('components.users.lists.all-users')

    <!-- Pagination -->
    <div class="padding-top-sm">
        @include('components.layouts.partials.pagination', ['items' => $users])
    </div>

    </div>
</div>
@endsection
