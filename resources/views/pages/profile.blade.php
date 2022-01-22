@extends('apps.master')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">

    <!-- Author Box -->
        <!-- Author Picture -->
        <div class="author author--featured padding-bottom-sm">
          <a href="#0" class="author__img-wrapper">
            <img src="/assets/img/author-img-1.jpg" alt="Author picture">
          </a>
          <h2>@Olivia</h2>
          <p class="color-contrast-medium text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia minus culpa commodi!</p>
        </div>
        <!-- END -->
    </div>
    <!-- END -->

<!-- New Arts-->
<section class="team padding-y-md">
  <div class="container max-width-adaptive-lg">
    <div class="margin-bottom-lg">
      <div class="flex justify-left items-end justify-between@md">
        <h2>New Arts</h2>
        <a href="#0" class="btn btn--accent btn--sm radius-xxl" role="text">New</a>
        <a href="#0" class="btn btn--basic btn--sm radius-xxl" role="text">Popular</a>
      </div>
    </div>

    <div class="grid gap-sm">
      <a class="card-v2 radius-md col-3@md" href="/post.html">
        <figure>
          <img src="/assets/img/team-img-1.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">James Powell</div>
            <div class="margin-top-xxxs text-sm opacity-70%">Designer</div>
          </figcaption>
        </figure>
      </a>

      <a class="card-v2 radius-md col-3@md" href="/post.html">
        <figure>
          <img src="/assets/img/team-img-2.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Emily Ewing</div>
            <div class="margin-top-xxxs text-sm opacity-70%">Developer</div>
          </figcaption>
        </figure>
      </a>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-3.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Mathew Burford</div>
            <div class="margin-top-xxxs text-sm opacity-70%">SVP of marketing</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-4.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Olivia Gribben</div>
            <div class="margin-top-xxxs text-sm opacity-70%">CEO</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-4.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Olivia Gribben</div>
            <div class="margin-top-xxxs text-sm opacity-70%">CEO</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-1.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">James Powell</div>
            <div class="margin-top-xxxs text-sm opacity-70%">Designer</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-2.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Emily Ewing</div>
            <div class="margin-top-xxxs text-sm opacity-70%">Developer</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-3.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Mathew Burford</div>
            <div class="margin-top-xxxs text-sm opacity-70%">SVP of marketing</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-4.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Olivia Gribben</div>
            <div class="margin-top-xxxs text-sm opacity-70%">CEO</div>
          </figcaption>
        </figure>
      </div>

      <div class="card-v2 radius-md col-3@md">
        <figure>
          <img src="/assets/img/team-img-4.jpg" alt="Image description">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-center">
            <div class="text-md text-base@md">Olivia Gribben</div>
            <div class="margin-top-xxxs text-sm opacity-70%">CEO</div>
          </figcaption>
        </figure>
      </div>

    </div>
  </div>
</section>
<!-- END -->
</div>
 @endsection
