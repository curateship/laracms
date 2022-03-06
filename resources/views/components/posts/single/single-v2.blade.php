<article class="margin-top-md">
  <header class="container max-width-md">
    <div class="text-component text-center line-height-lg text-space-y-md padding-bottom-md">
      <h1>It was going to be a lonely trip back</h1>
    </div>
  </header>

  <div class="container max-width-adaptive-sm">
    <div class="text-component line-height-lg text-space-y-md text-center">
      <div class="margin-top-md">{!! $post->body() !!}</div>
    </div>
  </div>

  <figure class="container max-width-lg margin-bottom-xs">
    <img class="block width-100% radius-lg display@md" src="{{ url('/storage').config('images.posts_storage_path').$post->original  }}" alt="Image description">
    <img class="block width-100% radius-lg display@xxs hide@md" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Image description">

  </figure>

</article>