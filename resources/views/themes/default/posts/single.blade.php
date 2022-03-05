@extends('themes.default.layouts.app')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">
  <!-- Sticky Share Sidebar -->
  <div class="col-1@md display@md">
  <ul class="sticky-sharebar__list position-fixed position-sticky top-xs@xs">
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="twitter" data-text="Hi there! https://codyhouse.co via @CodyWebHouse" data-hashtags="#nuggets, #dev" href="https://twitter.com/intent/tweet">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Twitter</title><g><path d="M32,6.1c-1.2,0.5-2.4,0.9-3.8,1c1.4-0.8,2.4-2.1,2.9-3.6c-1.3,0.8-2.7,1.3-4.2,1.6C25.7,3.8,24,3,22.2,3 c-3.6,0-6.6,2.9-6.6,6.6c0,0.5,0.1,1,0.2,1.5C10.3,10.8,5.5,8.2,2.2,4.2c-0.6,1-0.9,2.1-0.9,3.3c0,2.3,1.2,4.3,2.9,5.5 c-1.1,0-2.1-0.3-3-0.8c0,0,0,0.1,0,0.1c0,3.2,2.3,5.8,5.3,6.4c-0.6,0.1-1.1,0.2-1.7,0.2c-0.4,0-0.8,0-1.2-0.1 c0.8,2.6,3.3,4.5,6.1,4.6c-2.2,1.8-5.1,2.8-8.2,2.8c-0.5,0-1.1,0-1.6-0.1C2.9,27.9,6.4,29,10.1,29c12.1,0,18.7-10,18.7-18.7 c0-0.3,0-0.6,0-0.8C30,8.5,31.1,7.4,32,6.1z"></path></g></svg>
      </a>
    </li>

    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="facebook" data-url="https://codyhouse.co" href="http://www.facebook.com/sharer.php">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Facebook</title><path d="M32,16A16,16,0,1,0,13.5,31.806V20.625H9.438V16H13.5V12.475c0-4.01,2.389-6.225,6.043-6.225a24.644,24.644,0,0,1,3.582.312V10.5H21.107A2.312,2.312,0,0,0,18.5,13v3h4.438l-.71,4.625H18.5V31.806A16,16,0,0,0,32,16Z"></path></svg>
      </a>
    </li>

    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="pinterest" data-description="Description for my Pinterest share" data-media="https://codyhouse.co/app/assets/img/social-sharing-img-1.jpg" href="http://pinterest.com/pin/create/button">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Pinterest</title><g><path d="M16,0C7.2,0,0,7.2,0,16c0,6.8,4.2,12.6,10.2,14.9c-0.1-1.3-0.3-3.2,0.1-4.6c0.3-1.2,1.9-8,1.9-8 s-0.5-1-0.5-2.4c0-2.2,1.3-3.9,2.9-3.9c1.4,0,2,1,2,2.3c0,1.4-0.9,3.4-1.3,5.3c-0.4,1.6,0.8,2.9,2.4,2.9c2.8,0,5-3,5-7.3 c0-3.8-2.8-6.5-6.7-6.5c-4.6,0-7.2,3.4-7.2,6.9c0,1.4,0.5,2.8,1.2,3.7c0.1,0.2,0.1,0.3,0.1,0.5c-0.1,0.5-0.4,1.6-0.4,1.8 C9.5,21.9,9.3,22,9,21.8c-2-0.9-3.2-3.9-3.2-6.2c0-5,3.7-9.7,10.6-9.7c5.6,0,9.9,4,9.9,9.2c0,5.5-3.5,10-8.3,10 c-1.6,0-3.1-0.8-3.7-1.8c0,0-0.8,3.1-1,3.8c-0.4,1.4-1.3,3.1-2,4.2c1.5,0.5,3.1,0.7,4.7,0.7c8.8,0,16-7.2,16-16C32,7.2,24.8,0,16,0z "></path></g></svg>
      </a>
    </li>

    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="linkedin" data-url="http://codyhouse.co" href="https://www.linkedin.com/shareArticle">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Linkedin</title><g><path d="M29,1H3A2,2,0,0,0,1,3V29a2,2,0,0,0,2,2H29a2,2,0,0,0,2-2V3A2,2,0,0,0,29,1ZM9.887,26.594H5.374V12.25H9.887ZM7.63,10.281a2.625,2.625,0,1,1,2.633-2.625A2.624,2.624,0,0,1,7.63,10.281ZM26.621,26.594H22.2V19.656c0-1.687,0-3.75-2.35-3.75s-2.633,1.782-2.633,3.656v7.126H12.8V12.25h4.136v1.969h.094a4.7,4.7,0,0,1,4.231-2.344c4.513,0,5.359,3,5.359,6.844Z"></path></g></svg>
      </a>
    </li>

    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="mail" data-subject="Email Subject" data-body="Content of my email." href="mailto:">
        <svg class="icon" viewBox="0 0 32 32"><title>Share by Email</title><g><path d="M28,3H4A3.957,3.957,0,0,0,0,7V25a3.957,3.957,0,0,0,4,4H28a3.957,3.957,0,0,0,4-4V7A3.957,3.957,0,0,0,28,3Zm.6,6.8-12,9a1,1,0,0,1-1.2,0l-12-9A1,1,0,0,1,4.6,8.2L16,16.75,27.4,8.2a1,1,0,1,1,1.2,1.6Z"></path></g></svg>
      </a>
    </li>
  </ul>
</div>
<!-- Sticky Share Sidebar END -->

<!-- Content Start -->
<div class="col-11@md">
  <div class="card">

    <figure class="card__img img-blend opacity-20%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="100%">
        <img class="radius-md post-image" src="{{ url('/storage').config('images.posts_storage_path').$post->medium  }}" alt="Card preview img">
    </figure>

  <div class="post-content padding-md">
    <div class="flex">
      <div class="post-content">
        <h1>{{ $post->title }}</h1>
        <div class="margin-top-md">{!! $post->body() !!}</div>
      </div>
  </div>
</div>

<div class="t-article-v3__divider" aria-hidden="true"><span></span></div>

  <div class="author padding-lg">
  <a href="#0" class="author__img-wrapper">
    <img src="/assets/img/author-img-1.jpg" alt="Author picture">
  </a>

  <div class="author__content text-component text-space-y-xxs text-xs">
    <h4>Hi! I'm <a class="link-subtle" href="#0" rel="author">Olivia Gribben</a></h4>
    <p class="color-contrast-medium text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
    <p class="text-sm"><a href="#0">@oliviagribben</a></p>
  </div>
</div>
<div class="border-top"></div>
<!-- Content END -->


      <!-- Comments -->
      <section class="comments padding-md">
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
      </section>
      <!-- END -->
          </div>
        </div>

    <!-- END -->

    <!-- Sidebar -->
      <div class="col-3@md">
        <a class="card-v14 padding-sm flex flex-column position-fixed position-sticky top-sm@xs" href="#">
          <h3 class="text-md">Profile Card</h3>
          <p class="color-contrast-medium text-sm padding-y-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia minus culpa commodi!</p>
          <div class="avatar-group">
            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-1.svg" alt="Emily Ewing" title="Emily Ewing">
              </figure>
            </div>

            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="James Powell">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-2.svg" alt="James Powell" title="James Powell">
              </figure>
            </div>

            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="Olivia Gribben">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-3.svg" alt="Olivia Gribben" title="Olivia Gribben">
              </figure>
            </div>

            <button class="avatar avatar--btn" aria-label="show all users">
              <figure aria-hidden="true" class="avatar__figure">
                <div class="avatar__users-counter"><span>+12</span></div>
              </figure>
            </button>
          </div>
          <!-- avatar-group -->
          <p class="text-right color-primary margin-top-auto">Explore →</p>
        </a>
      </div>
      <!-- END -->
 </div>
 @endsection
