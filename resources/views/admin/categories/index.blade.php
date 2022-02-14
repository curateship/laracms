@extends('admin.layouts.app')
@section('content')
@include('admin.partials.modal')
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
            <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
              <ol class="flex flex-wrap gap-xxs">
                <li class="breadcrumbs__item color-contrast-low">
                  <a href="/admin" class="color-inherit link-subtle">Home</a>
                  <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                </li>
                <li class="breadcrumbs__item color-contrast-high" aria-current="page">Categories</li>
              </ol>
            </nav>
              </div>
              @include('admin.categories.partials.control')
          </div>
          <!-- END Control Bar-->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower border-opacity-30%"></div><!-- Divider -->
          @include('admin.categories.partials.table')

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        <x-admin.sidebar/>
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>
</section

@endsection
