
<ul class="grid-auto-xs grid-auto-sm@sm grid-auto-lg@md gap-md align-bottom">

@foreach($recent_posts as $recent_post)
<li class="align-bottom">
  <a href="{{ route('post.show', $recent_post) }}">
    <figure class="margin-bottom-xs align-bottom">
     <img class="block width-100% radius-lg align-bottom" loading="lazy" src="{{ url('/storage').$recent_post->getPreviewImage()  }}" alt="Image description">
    </figure>
  </a>
    <div class="card__content recent-post-card line-height-1 margin-xxs align-bottom">
     <a href="{{ route('post.show', $recent_post) }}" class="link-subtle text-sm align-bottom">{{$recent_post->title}}</a>
      <p class="text-xs color-contrast-low padding-top-sm align-bottom">{{ $recent_post->created_at->diffforhumans() }}<br></p>
    </div>
</li>
@endforeach
</ul>
