@push('custom-scripts')
    @include('components.users.show.scripts-js')
@endpush

<!-- Avatar -->
<figure class="flex justify-center reveal-fx reveal-fx--scale z-index-overlay">
    {!! $user->getAvatar(false, ['width' => 100, 'height' => 100], ['block width-xxl height-xxl border border-bg border-2 shadow-sm card-author author__img-wrapper author--featured'])->content !!}
</figure>

<!-- User's name -->
<div class="flex justify-center margin-top-md">
    <h4>{{$user->name}}</h4>
</div>

<!-- User's stats -->
<ul class="flex flex-wrap gap-md justify-center text-sm padding-top-md">
  <li class="inline-flex items-center">
  <a href="#0" class="link-plain" aria-controls="user-followers">
    <span>Followers ({{count($followers)}})</span>
  </a>
  </li>

  <li class="inline-flex items-center">
  <a href="#0" class="link-plain" aria-controls="user-following">
    <span>Following ({{count($following)}})</span>
  </a>
  </li>
</ul>

<!-- Users Followers Modal -->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="user-followers">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">
    <div class="text-component">
    </div>

    <div class="text-component">
    <h1 class="text-base color-contrast-medium padding-bottom-sm">Followers ({{count($followers)}})</h1>
      @include('components.users.lists.my-followers-with-button', ['follow_list' => $followers])
    </div>
  </div>

  <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
</div>

<!-- Users Following Modal -->
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="user-following">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto padding-md bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-form-title" aria-describedby="modal-form-description">
    <div class="text-component">
    </div>

    <div class="text-component">
    <h1 class="text-base color-contrast-medium padding-bottom-sm">Following ({{count($following)}})</h1>
      @include('components.users.lists.my-followers-with-button', ['follow_list' => $following])
    </div>
  </div>

  <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
</div>

<!-- User`s bio -->
<div class="padding-y-md text-component text-sm">{{$user->bio}}</div>

@auth()
    @if($user->id != \Illuminate\Support\Facades\Auth::id())
        <!-- Follow -->
        <div class="flex justify-center padding-top-sm padding-bottom-sm">
            <ul class="choice-tags js-choice-tags">
                <li>
                    <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input-{{$user->id}}" data-user-id="{{$user->id}}">
                        <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$user->id}}" {{$followed ? 'checked' : ''}} data-user-id="{{$user->id}}">
                        <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                        <span class="follow-label" data-user-id="{{$user->id}}">{{$followed ? 'Unfollow' : 'Follow'}}</span>
                    </label>
                </li>
            </ul>
        </div>
    @endif
@endauth
