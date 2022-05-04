<div class="profile-author-box" style="{{$user->cover_medium != '' ? "background-image: url('".url('/storage'.config('images.users_storage_path').$user->cover_medium)."')" : ''}}">
    <!-- Author Picture -->
    <div class="author--featured padding-bottom-sm profile-author-avatar">
        <a href="/user/{{$user->id}}" class="author__img-wrapper {{$user->getAvatar()->in_storage ? '' : 'with-svg-box'}}">
            {!! $user->getAvatar(false, ['width' => 100, 'height' => 100])->content !!}
        </a>
        <h2>{{$user->name}}</h2>
    </div>

    <!-- Edit profile button -->
    @auth()
        @if($user->id == \Illuminate\Support\Facades\Auth::id())
            <div class="profile-edit-button-box">
                <a href="/user/edit" class="link-plain">
                    <button type="button" class="btn btn--subtle" data-status="draft">Edit profile</button>
                </a>
            </div>
        @endif
    @endauth
</div>
