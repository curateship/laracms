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

                  @if($favorite->user_id != Auth::id())
                      <div class="margin-top-xs" style="font-size: 14px;">
                          <a href="{{$favorite->author->username}}" class="color-inherit link-subtle" rel="author" target="_blank">
                              {{$favorite->author->username}}
                          </a>
                      </div>
                  @else
                      <div class="margin-top-xs" style="font-size: 12px;">
                          {{$favorite->public == 1 ? 'Public' : 'Private'}}
                      </div>
                  @endif

                  <p class="text-xs color-contrast-low padding-top-sm">{{$favorite->posts_count ?? 0 }} Items</p>
                  <p class="text-xs color-contrast-low padding-top-xs">{{$favorite->created_at->diffForHumans()}}</p>
              </div>
          </li>
      @endforeach
  </ul>

  @include('components.layouts.partials.pagination', ['items' => $favorites])
</section>
