@push('custom-scripts')
    @include('components.posts.lists.infinite-masonry.script-infinite-scroll')
    @include('components.posts.lists.infinite-masonry.script-masonry')
    @include('components.posts.lists.infinite-masonry.scripts')
@endpush

<div class="container max-width-lg position-relative">
    <div class="preload-box" aria-hidden="true">
        <ul class="grid preload-grid gap-sm">
            @for($i = 1 ; $i <= 12 ; $i++)
                <li class="preload-item">
                    <div class="ske ske--rect-16:9 margin-bottom-sm"></div>
                </li>
            @endfor
        </ul>
    </div>
</div>

<div class="masonry-grid"></div>
