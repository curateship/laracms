<script>
    (function() {
    $(document).on('click', '.follow-button-input', function(e){
        //e.preventDefault()

        const tagId = $(this).attr('data-tag-id')

        @if(\Illuminate\Support\Facades\Auth::guest())
            $('.follow-label[data-tag-id="' + tagId + '"]').html('Follow')
            $('.follow-button-input[data-tag-id="' + tagId + '"]').prop('checked', false)
            $('.choice-tag--checked[data-tag-id="' + tagId + '"]').removeClass('choice-tag--checked')
            location.href = '/login'
        @endif

        $.ajax({
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tagId: tagId,
            },
            url: '{{route('tags.follow')}}',
            type: 'POST',
            success:function(response){
                if(response.message === 'Unauthenticated.'){
                    location.href = '/login'
                }

                if(parseInt(response.status) === 1){
                    $('.follow-label[data-tag-id="' + tagId + '"]').html('Unfollow')
                    $('.follow-button-input[data-tag-id="' + tagId + '"]').prop('checked', true)
                }   else{
                    $('.follow-label[data-tag-id="' + tagId + '"]').html('Follow')
                    $('.follow-button-input[data-tag-id="' + tagId + '"]').prop('checked', false)
                    $('.choice-tag--checked[data-tag-id="' + tagId + '"]').removeClass('choice-tag--checked')
                }
            }
        });
    })
}());
</script>
