<div class="margin-bottom-lg">
      <div class="flex gap-sm flex-column flex-row@md justify-between items-center@md">
        <div>
          <h1 class="text-md">Comments ({{ count($post->comments) }})</h1>
        </div>
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
    </div>
    <ul class="margin-bottom-lg">
    @foreach($post->comments as $comment)
      <li class="comments__comment">
        <div class="flex items-start">
          <a href="#0" class="comments__author-img">
            <img class="block width-100% height-100% object-cover" src="{{ url('/storage').config('images.users_storage_path').$user->thumbnail  }}" alt="Author picture">
          </a>
          <div class="comments__content margin-top-xxxs">
            <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
              <p><a href="#0" class="color-contrast-high text-sm link-subtle" rel="author">{{ $comment->user->name }}</a></p>
              <p class="color-contrast-medium">{{ $comment->the_comment }}</p>
            </div>
            <div class="margin-top-xs text-sm">
              <div class="flex gap-xxs items-center">
                <time class="comments__time" aria-label="1 hour ago">{{ $comment->created_at->diffForHumans() }}</time>
              </div>
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
    @auth
    <form method="POST" action="{{ route('post.add_comment', $post) }}">@csrf
      <fieldset>
        <legend class="form-legend">Add a new comment</legend>
        <div class="margin-bottom-xs">
          <label class="sr-only" for="commentNewContent">Your comment</label>
          <textarea class="form-control width-100%" name="the_comment" id="the_comment" minlength="10" rows="3" required></textarea>
        </div>
        <div>
          <button class="btn btn--primary" input-type>Post comment</button>
        </div>
      </fieldset>
    </form>
    @endauth
    @guest
				<p class=""><a href="{{ route('login') }}">Login </a> OR <a href="{{ route('register') }}">Register</a> to write comments</p>
			@endguest