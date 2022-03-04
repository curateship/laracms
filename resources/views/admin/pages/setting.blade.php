@extends('apps.master')
@section('content')

<!-- Container -->
<div class="container max-width-lg padding-y-xl grid gap-md">

  <!-- Main Content Column-->
  <div class="col-12@md">
    <div class="background-bg shadow-md border radius-md padding-sm">

    Settings

    </div>
  </div>
 <!-- END content table-->

 <!-- Sidebar -->
  <div class="col-3@md">
  @include('admin.partials.sidebar')
  </div>
 <!-- END -->

</div><!-- Container END -->
@endsection