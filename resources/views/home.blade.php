@extends('apps.master')
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">
        @include('partials.recommended')
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
