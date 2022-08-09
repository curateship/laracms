@extends(config('theme.main_app_template'))
@section('content')

<div class="grid gap-md">

<!-- Popular Posts -->
<h1>Users</h1>
    @include('components.users.lists.all-users')

<!-- Pagination -->
<div class="padding-top-sm">
    @include('components.layouts.partials.pagination', ['items' => $users])
</div>

</div>
@endsection
