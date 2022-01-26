@extends('apps.master')
@section('content')
@include('admin.user.partials.modal')

<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
              @include('admin.user.partials.breadcrumb')
              </div>
              @include('admin.user.partials.control')
          </div>
          <!-- END Control Bar-->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          @include('admin.user.partials.table')<!-- Table-->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          @include('admin.user.partials.pagination')
          <!-- Table END -->

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>
</section

@endsection