@foreach($posts as $post)
<div class="grid-item">
    @if($post->thumbnail != '')
    <a class="thumb" href="{{ route('post.show', $post) }}">
        <figure class="card-v2">
            <img class="block width-500% radius-md radius-bottom-right-0 radius-bottom-left-0" src="{{ url('/storage').config('images.posts_storage_path').$post->thumbnail }}" alt="Image of {{ $post->title }}">
            <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-left">

            </figcaption>
        </figure>
    </a>
    @else
    <span class="card__img card__img-cropped bg-opacity-50%"></span>
    <div class="post-cell text-component line-height-xs v-space-xxs">

    </div>
    @endif
    <div class="user-cell bg-black radius-md radius-top-right-0 radius-top-left-0">
        <h3 class="padding-sm"><a class="color-contrast-medium link-plain" href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h3>
    </div>
</div>
@endforeach
