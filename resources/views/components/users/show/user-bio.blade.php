@push('custom-scripts')
    @include('components.users.show.scripts-js')
@endpush

<figure class="card__img img-blend" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg" data-blend-height="50%" style="background-color: var(--color-bg);">
    @if($user->cover_medium != '')
        <img class="radius-md" src="{{url('/storage'.config('images.users_storage_path').$user->cover_medium)}}" alt="Card preview img">
    @else
        <div style="height: 140px;"></div>
    @endif
</figure>

<!-- Avatar -->
<figure class="flex justify-center reveal-fx reveal-fx--scale z-index-overlay">
    {!! $user->getAvatar(false, ['width' => 100, 'height' => 100], ['block width-xxl height-xxl border border-bg border-2 shadow-sm card-author author__img-wrapper author--featured'])->content !!}
</figure>

<!-- User's name -->
<div class="flex justify-center margin-top-md">
    <h4>{{$user->name}}</h4>
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
