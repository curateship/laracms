<div class="container max-width-lg margin-top-md position-relative">
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

@push('custom-scripts')
    <script>
        (function() {
            $(document).ready(function(){
                $('.preload-box').fadeIn()

                const masonryBox = document.querySelector('.masonry-grid')

                if(masonryBox !== null){
                    // init Masonry;
                    var $grid = new Masonry(masonryBox, {
                        gutter: 20,
                        //percentPosition: true,
                        isFitWidth: true,
                        //transitionDuration: 0,
                    });

                    var infScroll = new InfiniteScroll('.masonry-grid', {
                        path: '/masonry/posts/page/@{{#}}?time=' + Date.now(),
                        append: '.grid-item',
                        history: false,
                        outlayer: $grid,
                        appendCallback: true,
                        status: '.loader-ellips'
                    });

                    infScroll.pageIndex = 0
                    infScroll.loadNextPage()

                    $('.masonry-grid').on( 'last.infiniteScroll', function( event, body, path ) {
                        $('.loader-ellips').hide()
                    });

                    $('.masonry-grid').on( 'append.infiniteScroll', function( event, body, path, items, response ) {
                        $grid.layout();

                        $('.preload-box').fadeOut()
                    });
                }
            })
        }());
    </script>
@endpush
