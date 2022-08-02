<ul class="grid-auto-xs grid-auto-sm@sm grid-auto-lg@md gap-md">

@forelse($posts as $post)
<li class="">
  <a href="{{ route('post.show', $post) }}">
    <figure class="margin-bottom-xs">
     <img class="block width-100%" loading="lazy" src="{{url('/storage'.config('images.posts_storage_path').$post->thumbnail)}}" alt="Image description">
    </figure>
  </a>
    <div class="card__content recent-post-card line-height-1 margin-xxs">
     <a href="{{ route('post.show', $post) }}" class="link-subtle text-sm">{{ \Illuminate\Support\Str::limit( $post->title, 40) }}</a>
      <p class="text-xs color-contrast-low padding-top-sm">{{ $post->created_at->diffforhumans() }}</p>
    </div>
</li>

@empty
<p class="">There are no posts related to this tag</p>
@endforelse
</ul>