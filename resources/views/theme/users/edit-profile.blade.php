@extends('theme.layouts.app')

@push('custom-scripts')
    @include('admin.users.script-js')
@endpush

@section('content')
@include('admin.partials.alerts')
<!-- 👇 Content Body Wrapper-->
 <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

      <!-- Edit Profile -->
      <div class="padding-bottom-md">
        @include('components.users.edit-profile')
      </div>

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('components.layouts.sidebars.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
@endsection
