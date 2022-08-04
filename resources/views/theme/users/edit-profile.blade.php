@extends(env('MAIN_APP_TEMPLATE'))

@push('custom-scripts')
    @include('admin.users.script-js')
@endpush

@section('content')
@include('admin.partials.alerts')

 <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">

      <!-- Edit Profile -->
      <div class="col-12@md card padding-md">
        <h3 class="padding-bottom-sm">Edit Profile</h3>
        @include('components.users.show.edit-profile')
      </div>

      <!-- Sidebar -->
      <div class="col-3@md">
        @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
            @include('admin.partials.sidebar-admin')
        @else
            @include('admin.partials.sidebar')
        @endif
      </div>

  </div>
</div>
@endsection
