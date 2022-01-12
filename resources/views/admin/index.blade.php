@extends('admin.apps.master')
@section('content')
<!-- 👇 Content Body Wrapper-->
<section class="padding-y-xxl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md">
    @include('admin.partials.table')
    @include('admin.partials.sidebar')
    </div>
  </div>
</section
@endsection