<div class="margin-bottom-md">
    <div class="carousel flex flex-column js-carousel" data-drag="on" data-overflow-items="on">
        <div class="carousel__wrapper order-2 overflow-hidden">
            <ol class="carousel__list">
                @foreach($popular_tags as $tag)
                    @if($tag->post_count == '')
                        @continue
                    @endif
                    <li class="carousel__item" style="width: 250px">
                        <div class="height-xxxxl">
                            @if($tag->thumbnail != '')
                                <div class="text-center">
                                    <img class="tags-carousel-image" src="{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}" alt="tag-icon">
                                </div>
                            @else
                                <div class="bg-contrast-lower tags-carousel-image-none"></div>
                            @endif

                            <div>
                                <a class="link-subtle tags-carousel-link" href="/tags/{{$popular_tags_category_name}}/{{$tag->slug}}">
                                    <span class="tags-carousel-name">{{$tag->name}}</span>
                                    <span class="color-contrast-low">{{$tag->post_count}}</span>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        <nav class="margin-bottom-xs order-1 no-js:is-hidden">
            <ul class="flex gap-xxxs justify-between">
                <li>
                    <button class="tags-carousel-arrows-left reset carousel__control carousel__control--prev js-carousel__control js-tab-focus">
                        <svg class="icon" viewBox="0 0 20 20">
                            <title>Show previous items</title>
                            <polyline points="13 2 5 10 13 18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </li>

                <li>
                    <button class="tags-carousel-arrows-right reset carousel__control carousel__control--next js-carousel__control js-tab-focus">
                        <svg class="icon" viewBox="0 0 20 20">
                            <title>Show next items</title>
                            <polyline points="7 2 15 10 7 18" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                </li>
            </ul>
        </nav>

    </div>
</div>
