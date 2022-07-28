<div class="card margin-bottom-md post-card" data-post-id="{{$post->id}}">
    <div class="flex justify-between mb-3">
        <div class="inline-flex items-baseline articles-v3__author padding-sm">
            <a href="{{$post->author() != null ? '/user/'.$post->author()->username : '#'}}" class="articles-v3__author-img ">
                {!! $post->author()->getAvatar(false, ['width' => 45, 'height' => 45], ['block', 'width-100%', 'height-100%', 'object-cover'])->content !!}
            </a>

            <div class="text-component text-sm line-height-xs text-space-y-xxs">
                <p>
                    <a href="{{$post->author() != null ? '/user/'.$post->author()->username : '#'}}" class="articles-v3__author-name" rel="author">{!! $post->author() != null ? $post->author()->name : '<span style="font-weight: bold;color:red;">Deleted User</span>' !!}</a>
                </p>
                <p class="color-contrast-medium">{{$post->created_at->diffForHumans()}}</p>
            </div>
        </div>

        <!-- Edit -->
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex flex-wrap">
                <button class="reset int-table__menu-btn margin-left-auto js-tab-focus margin-right-xs" data-label="Edit row" aria-controls="menu-example-{{$post->id}}">
                    <svg class="icon" viewBox="0 0 16 16">
                        <circle cx="8" cy="7.5" r="1.5" />
                        <circle cx="1.5" cy="7.5" r="1.5" />
                        <circle cx="14.5" cy="7.5" r="1.5" />
                    </svg>
                </button>
                <menu id="menu-example-{{$post->id}}" class="menu js-menu">
                    <li role="menuitem">
                        <a href="{{ route ('post.edit', $post->slug) }}" class="link-subtle">
                            <span class="menu__content js-menu__content">
                                <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                                    <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                                </svg>
                                <span>
                                    Edit
                                </span>
                            </span>
                        </a>
                    </li>

                    <li class="delete-post-context-menu" role="menuitem" data-post-id="{{$post->id}}">
                        <span class="menu__content js-menu__content">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 16 16">
                                <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                                <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                            </svg>
                            <span class="delete-post-context-menu" data-post-id="{{ $post->id }}">Delete</span>
                        </span>
                    </li>
                </menu>

            </div>
        </div>
    </div>

    <!-- Post Image and Title -->
    <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
    <h4 class="padding-sm">
        <a class="text-decoration-none color-inherit" href="{{route('post.show', $post)}}">{{$post->title}}</a>
    </h4>

    <figure>
        {!! $post->content !!}
    </figure>

    <!-- Excerpt -->
    <div class="padding-sm text-sm">
        {{$post->excerpt}}
        <a class="link-plain color-contrast-high" href="{{route('post.show', $post)}}">
            <span class="chip text-xs padding-xxxs">Read Full Post</span>
        </a>
    </div>

    <!-- Tags -->
    <div class="padding-sm text-left text-sm">
        @foreach(\App\Models\TagsCategories::all() as $category)
            @if(isset($post->tags[$category->id]) && count($post->tags[$category->id]) > 0)
                <div class="">
                    {{$category->name}}:
                    @foreach($post->tags[$category->id] as $tag)
                        <button class="chip chip--interactive text-sm margin-bottom-xxs">
                            <a class="link-subtle" href="/tags/{{$category->name}}/{{$tag->slug}}">
                                <i class="chip__label">{{$tag->name}}</i>
                            </a>
                        </button>
                    @endforeach()
                </div>
            @endif
        @endforeach
    </div>

    <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->

    <!-- Comments -->
    <section class="comments padding-x-xs">
        @include('components.comments.infinite-posts-list')
    </section>

    <!-- Interaction -->
    <footer class="card-v10__footer">
        <ul class="card-v10__social-list">
            <li class="card-v10__social-item">
                <button class="reset card-v10__social-btn js-tab-focus js-comments__vote-btn-like {{$post->user_liked ? 'comments__vote-btn--pressed' : ''}}" data-post-id="{{$post->id}}" aria-label="Like this content along with 120 other people">
                    <svg class="icon" viewBox="0 0 12 12">
                        <g>
                            <path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path>
                        </g>
                    </svg>

                    <span class="post-likes-count margin-right-xs" data-post-id="{{$post->id}}">{{$post->likes()->count()}}</span><span>Likes</span>
                </button>
            </li>

            <li class="card-v10__social-item">
                <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                    <svg class="icon" viewBox="0 0 12 12">
                        <g>
                            <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                        </g>
                    </svg>
                    <span>{{$post->commentsCount()}} Comments</span>
                </button>
            </li>

        </ul>
    </footer>
</div>
