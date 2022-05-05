    <div class="margin-bottom-md">
      <ul class="flex flex-column gap-xxs">

          @foreach($popular_tags as $tag)
              <a class="link-subtle" href="#">
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
