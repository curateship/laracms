@extends('theme.layouts.app')
@section('content')

<div class="padding-md padding-lg@md">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include('components.posts.lists.recent-posts.recent-posts-grid-hr')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <div class="container max-width-md text-component margin-top-lg">
      <h2 class="padding-bottom-sm color-contrast-medium">HentaiRing for all your Hentai needs!</h2>
      <p class="color-contrast-low">Look no further. HentaiRing has all your Hentai Fetish needs. From videos, gif and much more hentai content.</p>
      <p class="color-contrast-low read-more js-read-more" data-btn-class="read-more__btn js-tab-focus" data-ellipsis="off">Hentairing! is the BEST website where you can watch free hentai anime porn and view
        Hentai images without without limit. We have 1080P Hentai videos. Here are some of the Hentai Fetish on our site: Incest Hentai, Shota Hentai, Big Boobs Hentai, Uncensored Hentai, Shota Hentai, Pregnant Hentai, Subbed Hentai, Dubbed Hentai, Hardcore Hentai,
         Mother Hentai, Father Hentai, Sister Hentai, Teacher Hentai, Schoolgirl Hentai, Full HD Hentai, 4K Hentai, HD hentai porn, Creampie Hentai,
           Cum in pussy, e-hentai, e hentai, 4chan hentai, myanimelist hentai, kissanime hentai, hentai foundry, hentai manga, hentai school, school hentai, hentai stream, hentai download,
            hentai sex, cartoon porn, cartoon sex, wet pussy, sex games, hentai.tv hentai, hentai gifs, hentai masturbation, fap hentai, 
      </p>
    </div>

</div>
@endsection