@push('custom-scripts')
    @include('components.users.show.scripts-js')
@endpush

<figure class="card__img img-blend corner-shadow" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="50%" style="background-color: var(--color-bg-light);">
    @if($user->cover_medium != '')
        <div class="corner top right corner-bg-darker"></div>
        <img class="radius-md" src="{{url('/storage'.config('images.users_storage_path').$user->cover_medium)}}" alt="Card preview img">
    @else
        <div style="height: 120px;"></div>
    @endif

    @auth()
        @if($user->id == \Illuminate\Support\Facades\Auth::id())
            <button class="reset int-table__menu-btn js-tab-focus card-menu-button" data-label="Edit row" aria-controls="menu-example">
                <svg class="icon" viewBox="0 0 16 16">
                    <circle cx="8" cy="7.5" r="1.5" />
                    <circle cx="1.5" cy="7.5" r="1.5" />
                    <circle cx="14.5" cy="7.5" r="1.5" />
                </svg>
            </button>

            <!-- Dropdown -->
            <menu id="menu-example" class="menu js-menu">
                <li role="menuitem">
                    <a href="/user/edit" class="link-plain">
                      <span class="menu__content js-menu__content">
                        <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                          <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                        </svg>
                          <span>Edit</span>
                      </span>
                    </a>
                </li>
            </menu>
        @endif
        @endauth
</figure>

<!-- Avatar -->
<figure class="flex justify-center margin-bottom-sm reveal-fx reveal-fx--scale">
    {!! $user->getAvatar(false, ['width' => 100, 'height' => 100], ['block width-xxl height-xxl radius-50% border border-bg border-2 shadow-sm card-author'])->content !!}
</figure>

<!-- User's name -->
<div class="flex justify-center">
    <h4>{{$user->name}}</h4>
</div>

<!-- User`s bio -->
<div class="padding-md text-component text-sm">{{$user->bio}}</div>

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
