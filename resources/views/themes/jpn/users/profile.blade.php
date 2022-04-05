@extends('themes.jpn.layouts.app')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">
  
    <!-- Author Box -->
        <!-- Author Picture -->
        <div class="author author--featured padding-bottom-sm">
          <a href="#0" class="author__img-wrapper">
            <img src="/assets/img/author-img-1.jpg" alt="Author picture">
          </a>
          <h2>Olivia Smith</h2>
        </div>
        <!-- END -->
    </div>  
    <!-- END -->

<!-- My Posts-->
<section class="team padding-y-md">
  <div class="container max-width-adaptive-lg">
  <h2 class="padding-bottom-md">My Posts</h2>
    <ul class="grid-auto-xs grid-auto-sm@sm grid-auto-md@md gap-md">

    <li class="card">
    <div class="">
    <a href="/">
        <figure class="aspect-ratio-4:3 margin-bottom-xs">
        <img class="block width-100%" loading="lazy" src="https://codyhouse.co/app/assets/img/article-gallery-v3-img-1.jpg" alt="Image description">
        </figure>
    </a>
        <div class="card__content recent-post-card line-height-1 margin-xxs">
        <a href="/" class="link-subtle text-sm">Post Title</a>
        <p class="text-xs color-contrast-low padding-top-sm">2 Days Ago<br></p>
        </div>
    </li>

    <li class="card">
    <div class="">
    <a href="/">
        <figure class="aspect-ratio-4:3 margin-bottom-xs">
        <img class="block width-100%" loading="lazy" src="https://codyhouse.co/app/assets/img/article-gallery-v3-img-1.jpg" alt="Image description">
        </figure>
    </a>
        <div class="card__content recent-post-card line-height-1 margin-xxs">
        <a href="/" class="link-subtle text-sm">Post Title</a>
        <p class="text-xs color-contrast-low padding-top-sm">2 Days Ago<br></p>
        </div>
    </li>

    <li class="card">
    <div class="">
    <a href="/">
        <figure class="aspect-ratio-4:3 margin-bottom-xs">
        <img class="block width-100%" loading="lazy" src="https://codyhouse.co/app/assets/img/article-gallery-v3-img-1.jpg" alt="Image description">
        </figure>
    </a>
        <div class="card__content recent-post-card line-height-1 margin-xxs">
        <a href="/" class="link-subtle text-sm">Post Title</a>
        <p class="text-xs color-contrast-low padding-top-sm">2 Days Ago<br></p>
        </div>
    </li>

    <li class="card">
    <div class="">
    <a href="/">
        <figure class="aspect-ratio-4:3 margin-bottom-xs">
        <img class="block width-100%" loading="lazy" src="https://codyhouse.co/app/assets/img/article-gallery-v3-img-1.jpg" alt="Image description">
        </figure>
    </a>
        <div class="card__content recent-post-card line-height-1 margin-xxs">
        <a href="/" class="link-subtle text-sm">Post Title</a>
        <p class="text-xs color-contrast-low padding-top-sm">2 Days Ago<br></p>
        </div>
    </li>

    <li class="card">
    <div class="">
    <a href="/">
        <figure class="aspect-ratio-4:3 margin-bottom-xs">
        <img class="block width-100%" loading="lazy" src="https://codyhouse.co/app/assets/img/article-gallery-v3-img-1.jpg" alt="Image description">
        </figure>
    </a>
        <div class="card__content recent-post-card line-height-1 margin-xxs">
        <a href="/" class="link-subtle text-sm">Post Title</a>
        <p class="text-xs color-contrast-low padding-top-sm">2 Days Ago<br></p>
        </div>
    </li>

    </ul>
  </div>
</section>
<!-- END -->
</div>
 @endsection
