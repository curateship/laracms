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

                    const newReplyCount = $('.comment-reply[data-reply-id="' + itemId + '"]').length - 1
                    $('.reply-list-count[data-comment-id="' + itemId + '"]').html(newReplyCount)

                    $('.post-comment-form[data-item-id="' + itemId + '"][data-type="reply"]').parents('.comment-form-box').remove()

                    //$('.post-comments[data-post-id="' + response.post_id + '"]').html(response.comments);
                    //$('.comments__comment[data-comment-id="' + itemId + '"]').next('.comments__details').attr('open', 1)
                }

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

            if(parent.attr('open') !== undefined){
                console.log('Hide more comments')
                replyListBox.html('')
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
