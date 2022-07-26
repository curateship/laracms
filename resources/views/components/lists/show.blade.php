<section class="margin-bottom-lg">
  <ul class="grid-auto-xs grid-auto-sm@sm grid-auto-lg@md gap-md">

    @foreach($posts as $post)
          <li class="card">
              <a href="/post/{{$post->slug}}">
                  <figure class="aspect-ratio-4:3 margin-bottom-xs">
                      <img class="block width-100%" loading="lazy" src="{{'/storage'.config('images.posts_storage_path').$post->medium}}" alt="Image description">
                  </figure>
              </a>

              <div class="card__content recent-post-card line-height-1 margin-xxs">
                  <a href="/post/{{$post->slug}}" class="link-subtle text-sm">{{$post->name}}</a>
                  <p class="text-xs color-contrast-low padding-top-xs">{{$post->created_at->diffForHumans()}}</p>
              </div>
          </li>
    @endforeach

  </ul>

    @include('components.layouts.partials.pagination', ['items' => $posts])
</section>
