@push('custom-scripts')
    @include('components.users.scripts-js')
@endpush

<div class="user-cell">
  <div class="user-cell__body">
    <figure aria-hidden="true">
        {!! $post->author->getAvatar(false, ['width' => 40, 'height' => 40], ['user-cell__img'])->content !!}
    </figure>

    <div class="user-cell__content text-component line-height-md text-space-y-xxs">
      <p><a href="#0" class="color-contrast-high link-plain"><strong>{{$post->author->name}}</strong></a></p>
      <p class="color-contrast-medium">{{$post->author->bio}}</p>
    </div>
  </div>

  <fieldset>
  <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
    <li>
        <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input">
            <input class="sr-only" type="checkbox" id="follow-button-input" {{$followed ? 'checked' : ''}} data-user-id="{{$post->user_id}}">
            <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
            <span class="follow-label">{{$followed ? 'Unfollow' : 'Follow'}}</span>
        </label>
    </li>

  </ul>
</fieldset>
</div>
