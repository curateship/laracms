<script>
    (function() {
    $(document).on('click', '.js-comments__vote-btn', function(e){
        e.preventDefault()

        const postId = $(this).attr('data-post-id')
        const $this = $(this)

        $.ajax({
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                postId: postId,
            },
            url: '{{route('post.like')}}',
            type: 'POST',
            success:function(response){
                // Set current likes count;
                $('.post-likes-count[data-post-id="' + postId + '"]').html(response.likes)
                // If like removed or user remove like - hide style

                if(parseInt(response.error) === -1){
                    $this.removeClass('comments__vote-btn--pressed')
                }

                if(parseInt(response.error) === 0){
                    $this.addClass('comments__vote-btn--pressed')
                }
            }
        });
    })
}());
</script>
