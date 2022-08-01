<div class="margin-bottom-md">
    <section id="slider-container">
        <div id="slider-box">
            <div class="slider">
                @foreach($popular_tags as $tag)
                    <div class="slider-item" data-href="/tags/{{$popular_tags_category_name}}/{{$tag->slug}}">
                        @if($tag->thumbnail != '')
                            <div class="text-center">
                                <img class="tags-carousel-image" src="{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}" alt="tag-icon">
                            </div>
                        @else
                            <div class="bg-contrast-lower tags-carousel-image-none"></div>
                        @endif

                        <div class="link-subtle tags-carousel-link">
                            <span class="tags-carousel-name">{{$tag->name}}</span>
                            <span class="color-contrast-low">{{$tag->post_count}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="slider-left-arrow" onclick="scrollWithArrow('left')" title="Left"><</div>
        <div class="slider-right-arrow" onclick="scrollWithArrow('right')" title="Right">></div>
    </section>
</div>
