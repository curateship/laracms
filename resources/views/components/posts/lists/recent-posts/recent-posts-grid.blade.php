<section class="articles-v3">
  <ul class="grid gap-lg@md gap-md@xxs">

  @foreach($recent_posts as $recent_post)
    <li>
      <div class="grid gap-md items-start">
        <a href="{{ route('post.show', $recent_post) }}" class="articles-v3__img col-5@md col-6@xxs">

          <!-- Image -->
          <figure class="aspect-ratio-4:3">
            <img class="block width-100%" loading="lazy" src="{{ url('/storage').config('images.posts_storage_path').$recent_post->thumbnail  }}" alt="Image description">
          </figure>
        </a>

        <div class="col-10@md col-9@xxs">

          <!-- Post Title -->
          <div class="text-component articles-v3__headline">
            <h2 class=" text-lg@md text-sm@xxs text-md@xs"><a href="{{ route('post.show', $recent_post) }}">{{$recent_post->title}}</a></h2>
          </div>

          <!-- Excerpt -->
          <div class="color-contrast-medium text-sm padding-top-md display@md">
              {!! $recent_post->body('short', 200) !!}
          </div>
          <div class="articles-v3__author display@md padding-top-md">

            <!-- Author Image -->
            <a href="/user/{{$recent_post->author()->username}}" class="articles-v3__author-img">
                @if($recent_post->author() != null)
                    {!! $recent_post->author()->getAvatar(false, ['width' => 40, 'height' => 40], ['object-cover'])->content !!}
                @endif
            </a>

            <!-- Author name and time created -->
            <div class="text-component text-sm line-height-xs text-space-y-xxs">
              <p><a href="/user/{{$recent_post->author()->username}}" class="articles-v3__author-name" rel="author">{!! $recent_post->author() != null ? $recent_post->author()->name : '<span style="font-weight: bold;color:red;">Deleted User</span>' !!}</a></p>
              <p class="color-contrast-medium">{{ $recent_post->created_at->diffforhumans() }} </p>
            </div>

          </div>
        </div>
      </div>
    </li>
    @endforeach

  </ul>
</section>