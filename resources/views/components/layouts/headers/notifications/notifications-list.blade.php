<ul class="notif ">
    @foreach($notifications_list as $notification)
        <li class="notif__item cursor-pointer">
            <div class="notif__link flex padding-sm notifications-url" data-url="{{$notification->url}}" data-notification-id="{{$notification->id}}">

                <div class="margin-right-xs notification-avatar-box">
                    {!! $notification->author->getAvatar(false, ['width' => 40, 'height' => 40], ['notification-avatar color-accent'])->content; !!}
                </div>

                <div class="flex-grow margin-right-xs">

                    <div>
                        <p class="text-sm"><i class="font-semibold">{{$notification->title}}</i> {{$notification->content}}</p>
                        <p class="text-xs color-contrast-medium margin-top-xxxxs"><time>{{$notification->created_at->diffForHumans()}}</time></p>
                    </div>
                </div>
            </div>
        </li>
    @endforeach

    @if(count($notifications_list) == 0)
        <div class="text-sm text-center padding-sm">No unread notifications</div>
    @endif
</ul>
