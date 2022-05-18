<script>
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

            infScroll.on( 'load', function() {
                setTimeout(function(){
                    initBlend()
                }, 100)
            })

            $('.masonry-grid').on( 'last.infiniteScroll', function( event, body, path ) {
                $('.loader-ellips').hide()
            });

            $('.masonry-grid').on( 'append.infiniteScroll', function( event, body, path, items, response ) {
                $grid.layout();

                $('.preload-box').fadeOut()
            });
        }
    })
</script>
