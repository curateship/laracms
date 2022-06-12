@foreach($users as $user)
    <div class="user-cell margin-bottom-xs">
        <!-- Avatar and Name -->
        <div class="flex items-start">
            <a href="/user/{{$user->username}}" class="comments__author-img">
                {!! $user->getAvatar(false, ['width' => 45, 'height' => 45], ['block', 'width-100%', 'height-100%', 'object-cover'])->content !!}
            </a>

            <div class="margin-x-xs user-menu__meta">
                <a class="link-subtle" href="/user/{{$user->username}}">
                    <p class="text-sm">{{$user->name}}</p>
                </a>
                <p class="text-xs color-contrast-medium line-height-1 padding-top-xxxxs">{{$user->posts_count}} Posts</p>
            </div>
        </div>

        <!-- Follow Icon -->
        <div class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
                <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$user->follow_user_id != null ? 'choice-tag--checked' : ''}}" for="follow-button-input-user-{{$user->id}}" data-user-id="{{$user->id}}">
                    <input class="sr-only follow-button-input-user" type="checkbox" id="follow-button-input-user-{{$user->id}}" {{$user->follow_user_id != null ? 'checked' : ''}} data-user-id="{{$user->id}}">
                    <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                    <span class="follow-label" data-user-id="{{$user->id}}">{{$user->follow_user_id != null ? 'Unfollow' : 'Follow'}}</span>
                </label>
        </div>
    </div>
@endforeach
