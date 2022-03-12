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
                    $('.post-comments[data-post-id="' + response.post_id + '"]').html(response.comments);
                    $('.post-comment-form[data-item-id="' + itemId + '"][data-type="reply"]').parents('.comment-form-box').remove()

                    $('.comments__comment[data-comment-id="' + itemId + '"]').next('.comments__details').attr('open', 1)
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

    initPostCommentsForms()
    initReadMoreItems()
}());
</script>
