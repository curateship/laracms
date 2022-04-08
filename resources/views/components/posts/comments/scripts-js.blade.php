<script>
    (function() {
    /* Comments ajax */
    function initPostCommentsForms(){
        // Comments post form;
        $('.commentNewContent').each(function(){
            $(this).text()
            $(this).bind('input propertychange', function() {
                const postBtn = $('.postbtn[data-item-id="' + $(this).attr('data-item-id') + '"][data-type="' + $(this).attr('data-type') + '"]')

                console.log('[data-item-id="' + $(this).attr('data-item-id') + '"][data-type="' + $(this).attr('data-type') + '"]')

                postBtn.attr('disabled', true);

                if(this.value.length){
                    postBtn.attr('disabled', false);
                }
            });
        })
    }

    $(document).on('click', '.cancel-reply', function(){
        $(this).parents('.comment-form-box').remove()
    })

    $(document).on('click', '.load-more-reply', function(){
        const replyId = $(this).attr('data-reply-id')
        let lastCommentId
        $('.comment-reply-item[data-parent-comment-id="' + replyId + '"]').each(function(){
            lastCommentId = $(this).attr('data-comment-id')
        })

        $(this).remove()

        $.ajax({
            data: {
                commentId: replyId,
                lastCommentId: lastCommentId
            },
            url: '{{route('post-comment-reply-list')}}',
            type: 'GET',
            success:function(response){
                //replyListBox.html(response)

                $('.comment-reply-item[data-parent-comment-id="' + replyId + '"][data-comment-id="' + lastCommentId + '"]').after(response)

                initReadMoreItems()
            }
        });

    })

    $(document).on('click', '.load-more-comments', function(){
        const postId = $(this).attr('data-post-id')
        let lastCommentId
        $('.comments__comment').each(function(){
            lastCommentId = $(this).attr('data-comment-id')
        })

        $(this).remove()

        loadPostComments(postId, lastCommentId, '.post-comments[data-post-id="' + postId + '"]')
    })

    function loadPostComments(postId, lastCommentId, container){
        $.ajax({
            url: '/post/comment/get/' + postId + '/' + lastCommentId,
            type: 'GET',
            success:function(response){
                $(container).append(response)

                initReadMoreItems()
            }
        });
    }

    $(document).on('click', '.post-comment-bnt', function(e){
        e.preventDefault();
        const itemId = $(this).attr('data-item-id');
        const type = $(this).attr('data-type');

        $(this).html('Please wait...');
        const formData = new FormData($('.post-comment-form[data-item-id="' + itemId + '"]')[0]);
        const postResultMessage = $('.post-result-message[data-item-id="' + itemId + '"]');

        let url;
        if(type === 'new'){
            url = '{{route('post-comment-save')}}';
        }

        if(type === 'reply'){
            url = '{{route('post-comment-reply-save')}}';
        }

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function(response){
                if(type === 'new'){
                    $('.post-comments[data-post-id="' + itemId + '"]').html(response.comments);

                    $('.post-comment-bnt[data-item-id="' + itemId + '"]').html('Post comment');
                    postResultMessage.html(response.result).fadeIn()

                    if(response.error === false){
                        $('.commentNewContent[data-item-id="' + itemId + '"]').val('');
                    }

                    setTimeout(function(){
                        postResultMessage.fadeOut()
                    }, 3000)
                }

                if(type === 'reply'){
                    const replyCount = $('.comment-reply[data-reply-id="' + itemId + '"]').length - 1

                    // If added reply list already exist;
                    if(replyCount > 0){
                        $('.details__content[data-comment-id="' + itemId + '"] > ul').html(response.comments)
                    }   else{
                        // If this is first reply in list;
                        $('.comments__comment[data-comment-id="' + itemId + '"]').after(response.comments)
                    }

                    $('.reply-list-count[data-comment-id="' + itemId + '"]').html(response.total_replies)

                    // Open reply list, if this is first comment;
                    if(response.first_comment === true){
                        $('.comments__comment[data-comment-id="' + itemId + '"]').next('.comments__details').attr('open', 1)
                        $('.reply-arrow[data-comment-id="' + itemId + '"]').css('transform', 'rotate(90deg)')
                    }

                    $('.post-comment-form[data-item-id="' + itemId + '"][data-type="reply"]').parents('.comment-form-box').remove()
                }

                $('.comments-count').html(response.commentsCount)

                initReadMoreItems()
            }
        });
    })

    $(document).on('click', '.comments__label-btn', function(){
        const $this = $(this)
        const replyId = $this.attr('data-reply-id')

        $('.post-comment-form[data-type="reply"]').parent().remove()

        $.ajax({
            url: "{{route('post-comment-reply')}}?replyId=" + replyId,
            type: 'get',
            contentType: false,
            processData: false,
            success: function(response){
                $this.parents('.comments__comment').after(response)
                initPostCommentsForms()
            }
        });
    })

        $(document).on('click', '.show-comment-reply-list', function(){
            const commentId = $(this).attr('data-comment-id')
            const parent = $('.comments__details[data-comment-id="' + commentId + '"]')
            const replyListBox = $('.details__content[data-comment-id="' + commentId + '"] > ul')
            const arrow = $('.reply-arrow[data-comment-id="' + commentId + '"]')

            if(parent.attr('open') !== undefined){
                console.log('Hide more comments')
                replyListBox.html('')
                arrow.css('transform', 'rotate(0deg)')
            }   else{
                console.log('Show more comments')

                $.ajax({
                    data: {
                        commentId: commentId
                    },
                    url: '{{route('post-comment-reply-list')}}',
                    type: 'GET',
                    success:function(response){
                        replyListBox.html(response)
                        arrow.css('transform', 'rotate(90deg)')
                        initReadMoreItems()
                    }
                });
            }
        })

    loadPostComments({{$post->id}}, 0, '.post-comments[data-post-id="{{$post->id}}"]')
    initPostCommentsForms()
    initReadMoreItems()
}());
</script>
