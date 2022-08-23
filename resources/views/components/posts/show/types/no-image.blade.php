<!-- Post Title -->
<div class="text-component padding-top-lg padding-bottom-md">
  <h1 class="text-xxl">{{ $post->title }}</h1>
</div>

<!-- Post Body -->
<div class="text-center">
  <div class="text-component line-height-lg text-space-y-md">
    <div class="margin-top-md">{!! $post->body() !!}</div>
  </div>

  <!-- Tags -->
  <div class="text-left text-sm padding-top-md">
    @foreach(\App\Models\TagsCategories::all() as $category)
        @if(isset($post_tags[$category->id]) && count($post_tags[$category->id]) > 0)
          <div class="">
            {{$category->name}}:
              @foreach($post_tags[$category->id] as $tag)
                <button class="chip chip--interactive text-sm margin-bottom-xxs">
                  <a class="link-subtle" href="/tags/{{$category->name}}/{{$tag->slug}}">
                    <i class="chip__label">{{$tag->name}}</i>
                            </a>
                </button>
              @endforeach()
          </div>
        @endif
    @endforeach
  </div>
</div>

@push('custom-scripts')
    <script>
        initImagesZoom()
    </script>
@endpush
