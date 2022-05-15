<!-- Comments -->
<ul class="margin-top-sm post-comments" data-post-id="{{$post->id}}"></ul>

<!-- Add Comment Form -->
<div class="margin-top-lg margin-bottom-sm">
  @auth
      @include('components.posts.comments.clean-comment-form')
  @endauth
</div>
<!-- If guest -->
@guest
    <p class=""><a href="{{ route('login') }}">Login </a> OR <a href="{{ route('register') }}">Register</a> to write comments</p>
@endguest

