<div class="profile-author-box" style="{{$user->cover_medium != '' ? "background-image: url('".url('/storage'.config('images.users_storage_path').$user->cover_medium)."')" : ''}}">
    <!-- Author Picture -->
    <div class="author--featured padding-bottom-sm profile-author-avatar">
        <a href="/user/{{$user->id}}" class="author__img-wrapper {{$user->thumbnail == '' ? 'with-svg-box' : ''}}">
            @if($user->thumbnail != '')
                <img src="{{ url('/storage'.config('images.users_storage_path').$user->thumbnail) }}" alt="Author picture">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 25 25">
                    <title>face-man</title>
                    <g class="icon__group none-avatar" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(0.5 0.5)">
                        <path fill="none" stroke-miterlimit="10"
                              d="M1.051,10.933 C4.239,6.683,9.875,11.542,16,6c3,4.75,6.955,4.996,6.955,4.996"></path>
                        <circle data-stroke="none" fill="currentColor" cx="7.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                stroke-linecap="square" stroke="none"></circle>
                        <circle data-stroke="none" fill="currentColor" cx="16.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                stroke-linecap="square" stroke="none"></circle>
                        <circle fill="none" stroke="currentColor" stroke-miterlimit="10" cx="12" cy="12" r="11"></circle>
                    </g>
                </svg>
            @endif
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
    <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags profile-edit-button-box margin-right-xxl padding-right-sm">
    <li>
      <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag" for="checkbox-tag-phone-call">
        <input class="sr-only" type="checkbox" id="checkbox-tag-phone-call" checked>
  
        <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
  
        <span>Follow</span>
      </label>
    </li>
    </ul>
    </div>

</div>
