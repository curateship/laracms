<div class="margin-bottom-md">
  <ul class="flex flex-wrap gap-xxs">

  @foreach($tags as $tag)
      <a class="link-subtle" href="/tags/{{$tag->cat_name}}/{{$tag->slug}}">
          <li>
              <span class="chip text-sm">
                  @if($tag->thumbnail != '')
                      <img class="chip__img" src="{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}" alt="tag-icon">
                  @endif
                <i class="chip__label">{{$tag->name}}</i>
              </span>
          </li>
      </a>
  @endforeach

  </ul>
</div>
