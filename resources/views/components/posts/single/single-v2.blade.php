<article class="margin-top-md">
  <header class="container max-width-md">

    <div class="text-component text-center line-height-lg text-space-y-md padding-bottom-md">
      <h1>{{ $post->title }}</h1>
    </div>
  </header>

  <figure class="container max-width-lg margin-bottom-md">
    <img class="radius-lg width-100%" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Image description">
  </figure>
  <div class="container max-width-adaptive-sm">
    <div class="text-component line-height-lg text-space-y-md text-center">
      <div class="margin-top-md">{!! $post->body() !!}</div>
    </div>
  </div>

</article>