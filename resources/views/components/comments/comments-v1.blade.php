<div class="flex gap-sm flex-column flex-row@md justify-between items-center@md">
    <div>
        <!-- Comment header and counts -->
        <h1 class="text-md margin-bottom-md">Comments ({{ $post->commentsCount() }})</h1>
    </div>

  <!-- Sorting -->
  <form aria-label="Choose sorting option">
    <div class="flex flex-wrap gap-sm text-sm">
      <div class="position-relative">
        <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsPopular" checked>
        <label for="sortCommentsPopular">Popular</label>
      </div>
      <div class="position-relative">
        <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsNewest">
        <label for="sortCommentsNewest">Newest</label>
      </div>
    </div>
  </form>
</div>

<!-- Comments -->
<ul class="margin-bottom-lg margin-top-sm post-comments" data-post-id="{{$post->id}}">
    <!-- Now we got comments list over AJAX -->
</ul>

<!-- Add Comment Form -->
@auth
    @include('components.posts.comments.form', ['title' => 'Add a new comment', 'item_id' => $post->id, 'type' => 'new'])
@endauth
<!-- If guest -->
@guest
    <p class=""><a href="{{ route('login') }}">Login </a> OR <a href="{{ route('register') }}">Register</a> to write comments</p>
@endguest

