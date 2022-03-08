
<!-- Post Title -->
<div class="text-component padding-bottom-md">
  <h1 class="text-xl">{{ $post->title }}</h1>
</div>

<!-- Post Image -->
<figure class="text-center padding-bottom-sm">
  <img class="radius-lg" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Image description">
</figure>

<!-- Post Body -->
<div class="text-center">
  <div class="text-component line-height-lg text-space-y-md">
    <div class="margin-top-md">{!! $post->body() !!}</div>
  </div>
</div>