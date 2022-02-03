<section class="margin-bottom-lg">
    <ul class="grid-auto-md gap-md">
    @foreach($posts as $post)
      <a class="card-v2 radius-md" href="#0">
      <figure>
        <img class="block width-100%" src="/assets/img/product-img-3.jpg" alt="placeholder">
        <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-left">
          <div class="margin-top-xxxs text-sm opacity-70%">{{ $post->title }}</div>
        </figcaption>
        </figure>
      </a>
      @endforeach
    </ul>
</section>
