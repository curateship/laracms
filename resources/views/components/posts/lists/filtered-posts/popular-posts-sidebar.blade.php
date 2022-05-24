<ul class="grid-auto-xs grid-auto-sm@sm grid-auto-md@md gap-md">
@foreach($popular_posts as $post)
<li class="card">
 <div class="">
  <a href="{{ route('post.show', $post) }}">
    <figure class="aspect-ratio-4:3 margin-bottom-xs">
     <img class="block width-100%" loading="lazy" src="{{ url('/storage').config('images.posts_storage_path').$post->thumbnail  }}" alt="Image description">
    </figure>
  </a>
    <div class="card__content recent-post-card line-height-1 margin-xxs">
     <a href="{{ route('post.show', $post) }}" class="link-subtle text-sm">{{ \Str::limit( $post->title, 55) }}</a>
        <div class="flex justify-between" style="align-items: baseline">
            <div class="text-xs color-contrast-low padding-top-sm">{{ $post->created_at->diffforhumans() }}</div>
            <button class="reset card-v10__social-btn" aria-label="Comment" style="outline: none;width: auto">
                <svg class="icon" viewBox="0 0 12 12">
                    <g>
                        <path d="M11.87 5.71c-0.1-0.15-2.38-3.72-5.89-3.72s-5.8 3.57-5.9 3.72a0.5 0.5 0 0 0 0 0.53c0.1 0.15 2.38 3.72 5.9 3.72s5.8-3.57 5.89-3.72a0.5 0.5 0 0 0 0-0.53z m-5.89 3.25c-2.46 0-4.3-2.21-4.88-2.98a8.31 8.31 0 0 1 2.93-2.53 2.47 2.47 0 0 0-0.54 1.53 2.49 2.49 0 0 0 4.98 0 2.47 2.47 0 0 0-0.54-1.52 8.36 8.36 0 0 1 2.92 2.52c-0.57 0.78-2.41 2.99-4.87 2.98z"></path>                                 </g>
                </svg>
                <span>{{$post->views_count}}</span>
            </button>
        </div>
    </div>
 </div>
@endforeach
</ul>

