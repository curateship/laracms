@extends('admin.apps.master')
@section('content')
  
<!-- 👇 Content Body Wrapper-->
<section class="margin-y-md">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">@include('admin.partials.table')</div>
      <div class="col-3@md">@include('admin.partials.sidebar')</div>
    </div>
  </div>
</section
@endsection