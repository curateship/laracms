<section class="articles-v3">
    <ul class="grid gap-lg">
    @foreach($recent_posts as $recent_post)
      <li>
        <div class="grid gap-md items-start">
          <a href="{{ route('post.show', $recent_post) }}" class="articles-v3__img col-5@md col-6@xs">
            <figure class="aspect-ratio-4:3">
              <img src="{{ url('/storage').config('images.posts_storage_path').$recent_post->medium  }}" alt="Image description">
            </figure>
          </a>
    
          <div class="col-10@md col-9@xs">
            <div class="text-component">
              <h2 class="articles-v3__headline"><a href="{{ route('post.show', $recent_post) }}">{{ \Str::limit( $recent_post->title, 40) }}</a></h2>
              <p>{{ \Str::limit( $recent_post->title, 40) }}</p>
            </div>
    
            <div class="articles-v3__author">
              <a href="#0" class="articles-v3__author-img">
                <img src="https://codyhouse.co/demo-templates/venere/assets/img/article-gallery-v3-img-1.jpg" alt="Author picture">
              </a>
        
              <div class="text-component text-sm line-height-xs text-space-y-xxs">
                <p><a href="#0" class="articles-v3__author-name" rel="author">{!! $recent_post->author != null ? $recent_post->author->name : '<span style="font-weight: bold;color:red;">Deleted User</span>' !!}</a></p>
                <p class="color-contrast-medium">{{ $recent_post->created_at->diffforhumans() }} </p>
              </div>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
</section>