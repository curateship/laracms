@foreach($posts as $post)
    @if(isset($post->follow_tags))
        @include('components.posts.lists.infinite-posts.item-tag')
    @else
        @include('components.posts.lists.infinite-posts.item')
    @endif
@endforeach
