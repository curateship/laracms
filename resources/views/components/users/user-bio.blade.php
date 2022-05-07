@push('custom-scripts')
    @include('components.users.scripts-js')
@endpush

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
        <div class="profile-edit-button-box">
        @if($user->id == \Illuminate\Support\Facades\Auth::id())
            <a href="/user/edit" class="link-plain">
                <button type="button" class="btn btn--subtle" data-status="draft">Edit profile</button>
            </a>
        @else
            <ul class="choice-tags js-choice-tags profile-edit-button-box padding-right-sm">
                <li>
                    <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input">
                        <input class="sr-only" type="checkbox" id="follow-button-input" {{$followed ? 'checked' : ''}} data-user-id="{{$user->id}}">
                        <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                        <span class="follow-label">{{$followed ? 'Unfollow' : 'Follow'}}</span>
                    </label>
                </li>
            </ul>
        @endif
        </div>
    @endauth

</div>
