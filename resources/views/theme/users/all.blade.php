@extends(config('theme.main_app_template'))

@push('custom-scripts')
    @include('theme.posts.most-posts-scripts')
@endpush

@section('content')

<div class="flex flex-column text-component padding-bottom-md gap-xs flex-row@md justify-between@md items-center@md">
<h1>Users</h1>

    <!-- Date Filter -->
    <div class="inline-flex items-baseline">
        <label class="text-sm color-contrast-medium margin-right-xs" for="selectThis">Sort:</label>

        <div class="select inline-block js-select" data-trigger-class="reset text-sm color-contrast-high text-underline inline-flex items-center cursor-pointer js-tab-focus">
            <select name="selectThis" id="selectThis" class="most-posts-filter">
                <option value="/users" {{request()->get('filter') == null ? 'selected' : ''}}>All Time</option>
                <option value="/users?filter=today" {{request()->get('filter') == 'today' ? 'selected' : ''}}>Today</option>
                <option value="/users?filter=week" {{request()->get('filter') == 'week' ? 'selected' : ''}}>Week</option>
                <option value="/users?filter=month" {{request()->get('filter') == 'month' ? 'selected' : ''}}>Month</option>
            </select>

            <svg class="icon icon--xxxs margin-left-xxs" viewBox="0 0 8 8"><path d="M7.934,1.251A.5.5,0,0,0,7.5,1H.5a.5.5,0,0,0-.432.752l3.5,6a.5.5,0,0,0,.864,0l3.5-6A.5.5,0,0,0,7.934,1.251Z"/></svg>
        </div>
    </div>
</div>

<div class="padding-bottom-md">
    @include('components.users.lists.all-users')
</div>

<!-- Pagination -->
<div class="padding-top-sm">
    @include('components.layouts.partials.pagination', ['items' => $users])
</div>

</div>
@endsection
