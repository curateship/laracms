@foreach($posts as $post)
<div class="grid-item">
    @if($post->thumbnail != '')
    <figure class="card__img img-blend" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="45%">
      <a class="" href="{{ route('post.show', $post) }}">
        <img class="radius-md radius-bottom-right-0 radius-bottom-left-0" src="{{ url('/storage').config('images.posts_storage_path').$post->thumbnail }}" alt="Image of {{ $post->title }}">
      </a>
    </figure>
    @else
    </div>

    @endif
    <div class="bg-dark radius-md radius-top-right-0 radius-top-left-0">
        <h3 class="padding-sm"><a class="color-contrast-medium link-plain" href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h3>
    </div>
@endforeach
