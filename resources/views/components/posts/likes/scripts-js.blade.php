<script>
    (function() {
    $(document).on('click', '.js-comments__vote-btn', function(e){
        e.preventDefault()

        const postId = $(this).attr('data-post-id')

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
            }
        });
    })
}());
</script>
