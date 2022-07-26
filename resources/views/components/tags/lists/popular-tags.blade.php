    <div class="margin-bottom-md">
      <ul class="flex flex-wrap gap-xxs">

          @foreach($popular_tags as $tag)
              @if($tag->post_count == '')
                  @continue
              @endif
              <a class="link-subtle" href="/tags/{{$popular_tags_category_name}}/{{$tag->slug}}">
                  <li>
                      <span class="chip text-sm">
                          @if($tag->thumbnail != '')
                              <img class="chip__img" src="{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}" alt="tag-icon">
                          @endif
                        <i class="chip__label">{{$tag->name}}</i>
                        <p class="color-contrast-low padding-right-xxs">{{$tag->post_count}}</p>
                      </span>
                  </li>
              </a>
          @endforeach

      </ul>
    </div>
