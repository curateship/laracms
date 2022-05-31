<!-- Post Image With Gradiant -->
<figure class="card__img img-blend opacity-20%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="100%">
    <img class="radius-md post-image" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Card preview img">
</figure>

<!-- Post Body -->
<div class="post-content padding-md">
  <div class="flex">
    <div class="post-content">
      <h1>{{ $post->title }}</h1>
        <div class="margin-top-md">{!! $post->body() !!}</div>
    </div>
  </div>
</div>

<!-- Divider -->
<div class="t-article-v3__divider" aria-hidden="true"><span></span></div>

<!-- Author -->
<div class="author padding-lg">
  <a href="#0" class="author__img-wrapper">
    <img src="/assets/img/author-img-1.jpg" alt="Author picture">
  </a>

<div class="author__content text-component text-space-y-xxs text-xs">
  <h4>Hi! I'm <a class="link-subtle" href="#0" rel="author">Olivia Gribben</a></h4>
    <p class="color-contrast-medium text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
    <p class="text-sm"><a href="#0">@oliviagribben</a></p>