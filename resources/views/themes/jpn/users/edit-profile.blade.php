@extends('themes.jpn.layouts.app')

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
        <div class="card" data-table-controls="table-1">

        <div class="padding-md">
        <h3 class="padding-bottom-sm">Edit Profile</h3>

        <form action="/user/edit/{{$user->id}}" method='post' autocomplete="off" >
            @csrf

        <fieldset class="margin-bottom-xxs">

            <div class="margin-bottom-sm">
            <input class="form-control width-100%" type="text" value='{{ $user->name }}' name="name" placeholder="Edit Name" required>
            </div>

            <div class="margin-bottom-sm">
            <input class="form-control width-100%" type="text" value='{{ $user->email }}' name="email" placeholder="Edit Email" required>
            </div>

            <div class="margin-bottom-sm">
                <div class="flex justify-between margin-bottom-xxxs">
                <label class="form-label" for="input-password">Change Password</label>
                </div>

                <input class="form-control width-100% margin-bottom-sm" autocomplete="false" type="password" name="password" id="input-password" placeholder="Old Password">
                <input class="form-control width-100% margin-bottom-sm" autocomplete="false" type="password" name="new-password" id="input-password" placeholder="New Password">
                <input class="form-control width-100% margin-bottom-sm" autocomplete="false" type="password" name="confirm-password" id="input-password" placeholder="Confirm Password">


            </div>
        </fieldset>

    <!-- Edit Avatar -->
    <div class="file-upload inline-block">
        <label for="upload-file" class="file-upload__label btn btn--subtle">
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

        <input type="hidden" name="original" value="{{$user->original}}"/>
        <input type="hidden" name="thumbnail" value="{{$user->thumbnail}}"/>
        <input type="hidden" name="medium" value="{{$user->medium}}"/>

        <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif">

        <br><br>

        <div class="author author--featured padding-bottom-sm">
            <div class="author__img-wrapper">
                <img alt="thumbnail" id="upload-thumbnail" src="{{url('/storage'.config('images.users_storage_path').$user->thumbnail)}}">
            </div>
        </div>
</div>

  <div class="flex justify-end gap-xs">
        <button class="btn btn--primary">Save</button>
      </div>
   </form>
</div>
<!-- END Table-->



        </div><!-- END Col-12 Card Wrapper -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('components.layouts.sidebars.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
@endsection
