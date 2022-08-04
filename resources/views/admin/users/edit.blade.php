@extends(env('MAIN_APP_TEMPLATE'))

@push('custom-scripts')
    @include('admin.users.script-js')
@endpush

@section('content')
<div class="grid gap-md justify-between">
  <div class="col-12@md">
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
            <a href="/admin/users" class="color-inherit link-subtle">Users</a>
            <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
          </li>
          <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit {{ $user->name }}</li>
        </ol>
      </nav>
      </div>

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
            <div class="padding-bottom-sm">
                @error('username')
                <span class="form-control--error" role="alert">
            <strong>{{ $message }}</strong>
            </span>
                @enderror
                <input class="form-control width-100%" type="text" name="username" id="username" placeholder="Enter Username"
                       value="{{ old('username') }}@isset($user){{ $user->username }} @endisset">
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

          <div class="flex justify-start gap-lg padding-top-sm">

          <!-- Edit Avatar -->
          <div class="file-upload inline-block">
            <label for="avatar-upload-file" class="file-upload__label btn btn--subtle">
              <span class="flex items-center">
              <svg class="icon" viewBox="0 0 20 20" aria-hidden="true">
                <g fill="currentColor">
                  <path d="M18 12v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13V2"></path>
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7l5-5 5 5"></path>
                </g>
              </svg>
              <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Edit Avatar</span>
              </span>
              </label>
              <input type="hidden" name="avatar-original" value="{{$user->original}}"/>
              <input type="hidden" name="avatar-thumbnail" value="{{$user->thumbnail}}"/>
              <input type="hidden" name="avatar-medium" value="{{$user->medium}}"/>
              <input type="file" class="file-upload__input" name="image" id="avatar-upload-file" accept="image/jpeg, image/jpg, image/png, image/gif">
              <br><br>
              <div class="author author--featured padding-bottom-sm">
                  <div class="author__img-wrapper">
                      <img alt="thumbnail" id="avatar-upload-thumbnail" src="{{url('/storage'.config('images.users_storage_path').$user->thumbnail)}}" style="{{$user->thumbnail == '' ? 'display: none' : ''}}">
                  </div>
              </div>
          </div>

          <!-- Edit cover -->
          <div class="file-upload inline-block">
            <label for="cover-upload-file" class="file-upload__label btn btn--subtle">
            <span class="flex items-center">
              <svg class="icon" viewBox="0 0 20 20" aria-hidden="true">
                <g fill="currentColor">
                  <path d="M18 12v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13V2"></path>
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7l5-5 5 5"></path>
                </g>
              </svg>
            <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Edit Cover</span>
            </span>
              </label>
              <input type="hidden" name="cover-original" value="{{$user->cover_original}}"/>
              <input type="hidden" name="cover-thumbnail" value="{{$user->cover_thumbnail}}"/>
              <input type="hidden" name="cover-medium" value="{{$user->cover_medium}}"/>
              <input type="file" class="file-upload__input" name="image" id="cover-upload-file" accept="image/jpeg, image/jpg, image/png, image/gif">
              <br><br>
              <img alt="thumbnail" id="cover-upload-thumbnail" src="{{url('/storage'.config('images.users_storage_path').$user->cover_thumbnail)}}" style="{{$user->cover_thumbnail == '' ? 'display: none' : ''}}">
              </div>
            </div>
          <div class="margin-y-sm">
            <button class="btn btn--primary btn--md width-15%">Update</button>
          </div>
        </form>
      </form>
      </div>

    </div>
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
