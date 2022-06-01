@push('custom-scripts')
    @include('components.users.show.scripts-js')
@endpush

<form action="/user/edit/{{$user->id}}" method='post' autocomplete="off" >
  @csrf
  <fieldset class="margin-bottom-xxs">
    <div class="margin-bottom-sm">
    <input class="form-control width-100%" type="text" value='{{ $user->name }}' name="name" placeholder="Edit Name" required>
    </div>

      <div class="margin-bottom-sm">
          <input class="form-control width-100%" type="text" value='{{ $user->username }}' name="username" placeholder="Edit Username" required>
      </div>

    <div class="margin-bottom-sm">
    <input class="form-control width-100%" type="text" value='{{ $user->email }}' name="email" placeholder="Edit Email" required>
    </div>

    <!-- Bio -->
    <div class="character-count js-character-count">
    <textarea class="form-control width-100% js-character-count__input" name="bio" id="userBio" maxlength="300" placeholder="Enter your Bio">{{$user->bio}}</textarea>

    <div class="character-count__helper character-count__helper--dynamic text-sm margin-top-xxxs" aria-live="polite" aria-atomic="true">
      You have <span id="bioLength" class="js-character-count__counter">{{300 - strlen($user->bio)}}</span> characters left
    </div>

    <div class="character-count__helper character-count__helper--static text-sm margin-top-xxxs">Max 300 characters</div>
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

<div class="flex justify-start gap-lg">

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

<div class="flex justify-end gap-xs">
<button class="btn btn--primary">Save</button>
</div>
</form>



