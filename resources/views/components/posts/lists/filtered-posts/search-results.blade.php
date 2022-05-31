<div class="text-component padding-bottom-md">
  <h1 class="text-xl">{{$total}} Post related to *{{$search}}* are found</h1>
</div>

<section class="margin-bottom-lg">
<ul class="grid-auto-xs grid-auto-sm@sm grid-auto-md@md gap-md">

@forelse($posts as $post)
  <li class="card">
  <div class="">
    <a href="{{ route('post.show', $post) }}">
      <figure class="aspect-ratio-4:3 margin-bottom-xs">
      <img class="block width-100%" loading="lazy" src="{{url('/storage'.config('images.posts_storage_path').$post->thumbnail)}}" alt="Image description">
      </figure>
    </a>
      <div class="card__content recent-post-card line-height-1 margin-xxs">
      <a href="{{ route('post.show', $post) }}" class="link-subtle text-sm">{{ \Illuminate\Support\Str::limit( $post->title, 40) }}</a>
        <p class="text-xs color-contrast-low padding-top-sm">{{ $post->created_at->diffforhumans() }} <br></p>
      </div>
      @empty
      <p class="">Please try another term</p>
  </li>
  @endforelse

</ul>
</section>


    
