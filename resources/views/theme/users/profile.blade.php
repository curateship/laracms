@extends('themes.layouts.app')
@section('content')
<div class="container max-width-lg padding-y-lg grid gap-md">

    <!-- Author Box -->
    <div class="profile-author-box" style="background-image: url('{{ url('/storage'.config('images.users_storage_path').$user->cover_medium) }}')"></div>
        <!-- Author Picture -->
        <div class="author author--featured padding-bottom-sm profile-author-avatar">
            <a href="/user/{{$user->id}}" class="author__img-wrapper">
                <img src="{{ url('/storage'.config('images.users_storage_path').$user->thumbnail) }}" alt="Author picture">
            </a>
            <h2>{{$user->name}}</h2>
        </div>
    </div>
    <!-- END -->

    @auth()
        @if($user->id == \Illuminate\Support\Facades\Auth::id())
            <div class="flex justify-center gap-xs">
                <a href="/user/edit">
                    <button type="button" class="btn btn--primary" data-status="draft">Edit profile</button>
                </a>
            </div>
        @endif
    @endauth


<!-- My Posts-->
<section class="team padding-y-md">
  <div class="container max-width-adaptive-lg">
  <h2 class="padding-bottom-md">User Posts</h2>
    <ul class="grid-auto-xs grid-auto-sm@sm grid-auto-md@md gap-md">
    @foreach($posts as $post)
            <li class="card">
                <div class="">
                    <a href="/">
                        <figure class="aspect-ratio-4:3 margin-bottom-xs">
                            <img class="block width-100%" loading="lazy" src="{{url('/storage').config('images.posts_storage_path').$post->medium}}" alt="Image description">
                        </figure>
                    </a>
                    <div class="card__content recent-post-card line-height-1 margin-xxs">
                        <a href="/post/{{$post->slug}}" class="link-subtle text-sm">{{$post->title}}</a>
                        <p class="text-xs color-contrast-low padding-top-sm">{{$post->created_at->diffForHumans()}}<br></p>
                    </div>
                </div>
            </li>
    @endforeach
    </ul>

  <!-- Pagination -->
  @include('components.layouts.partials.pagination', ['items' => $posts])
  <!-- Pagination END-->
  </div>
</section>
<!-- END -->
 @endsection
