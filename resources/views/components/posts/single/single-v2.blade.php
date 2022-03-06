
<!-- Post Title -->
<div class="container max-width-sm text-component text-center line-height-lg text-space-y-md padding-bottom-md">
  <h1>{{ $post->title }}</h1>
</div>

<!-- Post Image -->
<figure class="container max-width-lg margin-bottom-md aspect-ratio-1:2">
  <img class="radius-lg" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Image description">
</figure>

<!-- Post Body -->
<div class="container max-width-adaptive-sm">
  <div class="text-component line-height-lg text-space-y-md text-center">
    <div class="margin-top-md">{!! $post->body() !!}</div>
  </div>
</div>