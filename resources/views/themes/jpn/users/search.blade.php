@extends('themes.jpn.layouts.app')
@section('content')
    <!-- My Posts-->
    <section class="margin-y-xl">
        <div class="container max-width-adaptive-lg padding-top-sm">

            <div class="text-component padding-bottom-md">
                <h1 class="text-xl">{{$total}} Post related to *{{$search}}* are found</h1>
            </div>

            <div class="grid gap-md justify-between">
                <div class="col-15@md">

                    <section class="margin-bottom-lg">
                        <ul class="grid-auto-sm gap-md tags-cols">

                            @forelse($posts as $post)
                                <li class="card">
                                    <div class="bg-light">
                                        <figure class="card__img img-blend" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="45%">
                                            <a href="{{ route('post.show', $post) }}"><img class="radius-md" src="{{url('/storage'.config('images.posts_storage_path').$post->thumbnail)}}" alt="Card preview img" style="width: 400px; height: 250px; object-fit: cover;"></a>
                                        </figure>
                                        <div class="card__content recent-post-card">
                                            <div class="flex">

                                                <div class="recent-post-card padding-xxxs">
                                                    <a href="{{ route('post.show', $post) }}" class="color-contrast-high link-subtle text-sm">{{ \Illuminate\Support\Str::limit( $post->title, 40) }}</a>
                                                    <p class="text-xs color-contrast-low padding-top-xxs">{{ \Illuminate\Support\Str::limit( $post->excerpt, 20) }}</p>
                                                    <p class="text-xs color-contrast-low padding-top-sm">{{ $post->created_at->diffforhumans() }} <br> {!! $post->author() != null ? $post->author()->name : '<span style="font-weight: bold;color:red;">Deleted User</span>' !!}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <footer class="card-v10__footer">
                                            <ul class="card-v10__social-list">
                                                <li class="card-v10__social-item">
                                                    <button class="reset card-v10__social-btn js-tab-focus" aria-label="Like this content along with 120 other people">
                                                        <svg class="icon" viewBox="0 0 12 12">
                                                            <g>
                                                                <path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path>
                                                            </g>
                                                        </svg>

                                                        <span>120</span>
                                                    </button>
                                                </li>

                                                <li class="card-v10__social-item">
                                                    <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                                                        <svg class="icon" viewBox="0 0 12 12">
                                                            <g>
                                                                <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                                                            </g>
                                                        </svg>
                                                        <span>{{ $post->commentsCount() }}</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </footer>
                                        @empty
                                        <p class="">No *{{$search}}* post where found</p>
                            @endforelse
                        </ul>
                    </section>
                    <!-- Pagination -->
                @include('components.layouts.partials.pagination', ['items' => $posts])
                <!-- Pagination END-->
    <!-- END -->
@endsection
