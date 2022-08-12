<ul class="grid gap-md">
    @foreach($posts as $post)
        <li class="card col-3@md">
            <div class="">
                <a href="/post/{{$post->slug}}">
                    <figure class="aspect-ratio-4:3 margin-bottom-xs">
                        <img class="block width-100% radius-md radius-bottom-right-0 radius-bottom-left-0" loading="lazy" src="{{url('/storage').$post->getPreviewImage()}}" alt="Image description">
                    </figure>
                </a>

                <div class="card__content recent-post-card line-height-1 margin-xxs">
                    <a href="/post/{{$post->slug}}" class="link-subtle text-sm">{{$post->title}}</a>
                    <p class="text-xs color-contrast-low padding-top-sm">{{$post->created_at->diffForHumans()}}<br></p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
