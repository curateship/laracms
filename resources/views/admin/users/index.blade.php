@extends('admin.layouts.app')
@section('content')
@include('admin.users.partials.modal')

<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
              @include('admin.users.partials.breadcrumb')
              </div>
              @include('admin.users.partials.control')
          </div>
          <!-- END Control Bar-->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          @include('admin.users.partials.table')<!-- Table-->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          {{ $users->links('admin.users.partials.pagination', ['users' => $users]) }}

          <!--@include('admin.users.partials.pagination')-->
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
