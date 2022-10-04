@extends(config('theme.admin_app_template'))
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
      @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
          @include('admin.partials.sidebar-admin')
      @else
          @include('admin.partials.sidebar')
      @endif
  </div>
 <!-- END -->

</div><!-- Container END -->
@endsection