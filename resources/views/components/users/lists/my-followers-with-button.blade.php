@foreach($follow_list as $user)
<div class="user-cell">
  <div class="user-cell__body">
  <a href="/user/{{$user->id}}">
    <figure class="avatar__figure avatar avatar--lg" role="img" aria-label="{{$user->name}}">
      {!! $user->getAvatar(false, ['width' => 50, 'height' => 50], ['avatar__img'])->content !!}
    </figure>
  </a>
  
    <div class="user-cell__content text-component line-height-sm text-space-y-xxs">
      <p><a href="/user/{{$user->id}}" class="color-contrast-high link-subtle text-sm">{{$user->name}}</a></p>
    </div>
  </div>

  <div class="user-cell__cta">
    <button class='btn btn--subtle'>Follow</button>
  </div>
</div>
@endforeach
