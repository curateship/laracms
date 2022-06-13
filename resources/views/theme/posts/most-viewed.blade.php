@extends('theme.layouts.app')
@section('content')

<!-- Container -->
<div class="container max-width-adaptive-lg padding-top-sm">

<div class="flex flex-column text-component padding-bottom-md gap-xs flex-row@md justify-between@md items-center@md">
    <h1 class="text-xl">Most viewed posts</h1>

<!-- Date Filter -->
<div class="inline-flex items-baseline">
  <label class="text-sm color-contrast-medium margin-right-xs" for="selectThis">Sort:</label>
  
  <div class="select inline-block js-select" data-trigger-class="reset text-sm color-contrast-high text-underline inline-flex items-center cursor-pointer js-tab-focus">
    <select name="selectThis" id="selectThis">
      <option value="0" selected>All Time</option>
      <option value="1">Today</option>
      <option value="2">Week</option>
      <option value="4">Month</option>
    </select>
    
    <svg class="icon icon--xxxs margin-left-xxs" viewBox="0 0 8 8"><path d="M7.934,1.251A.5.5,0,0,0,7.5,1H.5a.5.5,0,0,0-.432.752l3.5,6a.5.5,0,0,0,.864,0l3.5-6A.5.5,0,0,0,7.934,1.251Z"/></svg>
  </div>
</div>
</div>

<!-- Search Results -->
<div class="padding-bottom-md">
    @include('components.posts.lists.filtered-posts.most-viewed')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
    @include('components.layouts.partials.pagination', ['items' => $posts])
</div>

</div>
@endsection
