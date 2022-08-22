@push('custom-scripts')
    @include('components.users.show.scripts-js')
@endpush

<div class="user-cell">
  <div class="user-cell__body">
    <figure aria-hidden="true">
        <a href="{{$post->author != null ? '/user/'.$post->author->username : '#'}}" class="color-contrast-high link-plain">{!! $post->author != null ? $post->author->getAvatar(false, ['width' => 45, 'height' => 45], ['user-cell__img'])->content : '' !!}</a>
    </figure>

    <div class="user-cell__content text-component line-height-md text-space-y-xxs">
      <p><a href="{{$post->author != null ? '/user/'.$post->author->username : '#'}}" class="color-contrast-high link-plain"><strong>{{$post->author != null ? $post->author->name : 'Deleted user'}}</strong></a></p>
      <p class="color-contrast-medium">{{$post->author != null ? $post->author->bio : '...'}}</p>
    </div>
  </div>

    @if($post->author != null && $post->author->id != \Illuminate\Support\Facades\Auth::id())
      <fieldset>
          <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
            <li>
                <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input-{{$post->user_id}}" data-user-id="{{$post->user_id}}">
                    <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$post->user_id}}" {{$followed ? 'checked' : ''}} data-user-id="{{$post->user_id}}">
                    <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                    <span class="follow-label" data-user-id="{{$post->user_id}}">{{$followed ? 'Unfollow' : 'Follow'}}</span>
                </label>
            </li>
          </ul>
      </fieldset>
    @endif
</div>
