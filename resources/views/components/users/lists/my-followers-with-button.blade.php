@foreach($follow_list as $user)
<div class="user-cell">

  <!-- Avatar and Name -->
  <div class="user-cell__body">
    <a href="/user/{{$user->id}}">
      <figure class="avatar__figure avatar avatar--lg" role="img" aria-label="{{$user->name}}">
        {!! $user->getAvatar(false, ['width' => 48, 'height' => 48], ['avatar__img'])->content !!}
      </figure>
    </a>
    <a href="/user/{{$user->id}}" class="color-contrast-high link-subtle text-sm">{{$user->name}}</a>
  </div>

  <!-- Follow Icon -->
    @if(Auth::guest() || Auth::id() != $user->id)
        <ul class="choice-tags flex flex-wrap js-choice-tags">
            <li>
                <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$user->followed ? 'choice-tag--checked' : ''}}" for="checkbox-tag-phone-call-{{$user->id}}" data-user-id="{{$user->id}}">
                    <input class="sr-only follow-button-input" type="checkbox" id="checkbox-tag-phone-call-{{$user->id}}" {{$user->followed ? 'checked' : ''}} data-user-id="{{$user->id}}">
                    <svg class="choice-tag__icon icon" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                </label>
            </li>
        </ul>
    @endif
</div>
@endforeach
