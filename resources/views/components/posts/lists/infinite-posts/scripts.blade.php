<script>
    var infScroll = new InfiniteScroll('.infinite-posts-list', {
        path: '/infinite/posts/page/@{{#}}?time=' + Date.now(),
        append: '.post-card',
        history: false,
        //outlayer: $grid,
        appendCallback: true,
        //status: '.loader-ellips'
    });

    infScroll.on( 'load', function() {
        setTimeout(function(){
            $('.post-comments').each(function(){
                if($(this).html() === ''){
                    const postId = $(this).attr('data-post-id')
                    loadPostComments(postId, 0, '.post-comments[data-post-id="' + postId + '"]')
                }
            })

            initPostCommentsForms()
            initReadMoreItems()
            initImagesZoom()
            initMenuBars()
        }, 500)
    })

    infScroll.pageIndex = 0
    infScroll.loadNextPage()

    // Delete from user context menu;
    $(document).on('click', '.delete-post-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-post-dialog').dispatchEvent(event);
        $('#delete-posts-list').val($(this).attr('data-post-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete-posts', function(){
        deletePostsArray($('#delete-posts-list').val().split(','))
    })

    function deletePostsArray(selectedPosts){
        if(selectedPosts.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '/admin/posts/' + selectedPosts.join(','),
                type: 'POST',
                success:function(){
                    $('.post-card[data-post-id="' + selectedPosts[0] + '"]').fadeOut()
                    const event = new Event('closeDialog');
                    document.getElementById('delete-post-dialog').dispatchEvent(event);
                }
            });
        }
    }
</script>
