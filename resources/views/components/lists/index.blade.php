<section class="margin-bottom-lg">
  <ul class="grid-auto-xs grid-auto-sm@sm grid-auto-lg@md gap-md">
      @foreach($favorites as $favorite)
          <li class="card">
              <a href="/lists/show/{{$favorite->slug}}">
                  <figure class="aspect-ratio-4:3 margin-bottom-xs">
                      <img class="block width-100%" loading="lazy" src="{{'/storage'.config('images.lists_storage_path').$favorite->medium}}" alt="Image description">
                  </figure>
              </a>

              <div class="card__content recent-post-card line-height-1 margin-xxs">
                  <a href="/lists/show/{{$favorite->slug}}" class="link-subtle text-sm">{{$favorite->name}}</a>
                  <p class="text-xs color-contrast-low padding-top-sm">{{$favorite->posts_count ?? 0 }} Items</p>
                  <p class="text-xs color-contrast-low padding-top-xs">{{$favorite->created_at->diffForHumans()}}</p>
              </div>
          </li>
      @endforeach
  </ul>

  @include('components.layouts.partials.pagination', ['items' => $favorites])
</section>
