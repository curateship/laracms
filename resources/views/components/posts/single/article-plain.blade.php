
<!-- Post Title -->
<div class="container max-width-sm text-component text-center">
  <h1>{{ $post->title }}</h1>
</div>

<!-- Post Image -->
<figure class="container max-width-lg text-center">
  <img class="radius-lg" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Image description">
</figure>

<!-- Post Body -->
<div class="container max-width-sm">
  <div class="text-component line-height-lg text-space-y-md">
    <div class="margin-top-md">{!! $post->body() !!}</div>
  </div>
</div>