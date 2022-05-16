@foreach($follows as $user)
    <div class="padding-xs flex gap-xs items-center">
        <div class="avatar avatar--md flex justify-between">
            <figure class="avatar__figure" role="img" aria-label="{{$user->name}}">
                {!! $user->getAvatar(false, ['width' => 45, 'height' => 45], ['avatar__img'])->content !!}
            </figure>
        </div>
        <div class="text-sm">
            <a href="/user/{{$user->id}}" class="color-inherit link-subtle" target="_blank">{{$user->name}}</a>
        </div>
    </div>
@endforeach
