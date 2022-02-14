@extends('admin.layouts.app')
@section('content')

<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
              @include('admin.posts.partials.breadcrumb')
              </div>
              @include('admin.posts.partials.control')
          </div>
          <!-- END Control Bar-->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower border-opacity-30%"></div><!-- Divider -->
          @include('admin.posts.partials.table')<!-- Table-->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          @include('admin.posts.partials.pagination')

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
