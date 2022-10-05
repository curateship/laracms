@foreach($follows as $follow)
    <div class="margin-bottom-sm flex justify-between items-center contest-follower">
        <div class="flex gap-sm items-center">
            <div>
                <div class="avatar contest-follower-avatar">
                    <figure class="avatar__figure admin-follow-avatar-box" role="img" aria-label="{{$follow->name}}">
                        <a href="/user/{{$follow->username}}">{!! $follow->getAvatar(false, ['width' => 40, 'height' => 40], ['block'])->content !!}</a>
                    </figure>
                </div>
            </div>
            <div>
                <a href="/user/{{$follow->username}}" class="comments__author-name">{{$follow->name}}</a>
            </div>
        </div>
        <fieldset style="display: {{\Illuminate\Support\Facades\Auth::guest() ? 'none' : 'block'}}">
            <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
                <li>
                    <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag choice-tag--checked" for="follow-button-input-{{$follow->follow_id}}" data-follow-id="{{$follow->follow_id}}">
                        <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$follow->follow_id}}" checked data-follow-id="{{$follow->follow_id}}" data-contest-id="{{$follow->follow_contest_id}}">
                        <svg class="choice-tag__icon icon" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                        <span class="follow-label" data-follow-id="{{$follow->follow_id}}"></span>
                    </label>
                </li>
            </ul>
        </fieldset>
    </div>
@endforeach
