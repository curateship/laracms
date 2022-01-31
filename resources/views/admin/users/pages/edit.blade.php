@extends('apps.master')
@section('content')
@include('admin.partials.modal')

<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Breadcrumb -->
          <div class="controlbar--sticky flex justify-between">
          <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
            <ol class="flex flex-wrap gap-xxs">
              <li class="breadcrumbs__item color-contrast-low">
                <a href="/admin" class="color-inherit link-subtle">Home</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-low">
                <a href="/admin" class="color-inherit link-subtle">Users</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit {{ $user->name }}</li>
            </ol>
          </nav>
          </div>
          <!-- Breadcrumb END -->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->

          <!-- Edit Form Content 👇-->
          <div class="padding-md">
          <form action="{{ route('admin.users.update', $user->id) }}" method="POST">@csrf
            @method('PATCH')
            <form class="sign-up-form">

              <div class="text-component text-center">
              </div>

              <div class="padding-bottom-sm">
                @error('name')
                <span class="form-control--error" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input class="form-control width-100%" type="text" name="name" id="name" placeholder="Enter Name"
                value="{{ old('name') }}@isset($user){{ $user->name }} @endisset">
              </div>

              <div class="margin-bottom-sm">
                @error('email')
                <span class="form-control--error" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input class="form-control width-100%" type="email" name="email" id="input-email" placeholder="email@myemail.com"
                value="{{ old('email') }}@isset($user){{ $user->email }} @endisset">
              </div>

              <!-- Change Roles 👇-->
              <div>
                <div class="grid gap-xxs items-center@md padding-y-xs">
                  <div class="col-2@md">
                    <div class="form-label">Choose Roles</div>
                  </div>

                  <div class="col-12@md">
                    <ul class="flex flex-wrap gap-md">
                      @foreach($roles as $role)
                      <li>
                        <input class="checkbox" name="roles[]" type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                        @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset">
                        
                        <label for="{{ $role->name }}">{{ $role->name }}</label>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Change Roles END -->

              <div class="margin-y-sm">
                <button class="btn btn--primary btn--md width-15%">Update</button>
              </div>

            </form>
          </form>
          </div>
          <!-- Edit Form Content END -->
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
