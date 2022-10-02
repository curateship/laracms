<!-- Avatar group -->
<div class="avatar-group">

    @foreach($followers as $key => $follower)
        <div class="avatar contest-follower-avatar" style="display: {{$key >= 3 ? 'none' : 'block'}}">
            <figure class="avatar__figure" role="img" aria-label="{{$follower->name}}">
                <!--<svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>-->
                {!! $follower->getAvatar(false, ['width' => 40, 'height' => 40], ['block'])->content !!}
            </figure>
        </div>
    @endforeach

    @if(count($followers) > 3)
        <button class="avatar avatar--btn contest-show-all-followers" aria-label="show all users">
            <figure aria-hidden="true" class="avatar__figure">
                <div class="avatar__users-counter"><span>+{{count($followers) - 3}}</span></div>
            </figure>
        </button>

            <button class="avatar avatar--btn contest-hide-all-followers" aria-label="show all users">
                <figure aria-hidden="true" class="avatar__figure">
                    <div class="avatar__users-counter"><span>Hide</span></div>
                </figure>
            </button>
    @endif
</div>
