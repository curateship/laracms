<script>
(function() {
    $(document).on('click', '.follow-button-input-tag', function(){
        let url = '{{route('tags.follow')}}'
        let itemId = $(this).attr('data-tag-id')
        let key = 'tag-id'
        let data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            tagId: itemId,
        }

        @if(\Illuminate\Support\Facades\Auth::guest())
            $('.follow-label[data-' + key + '="' + itemId + '"]').html('Follow')
            $('.follow-button-input-tag[data-' + key + '="' + itemId + '"]').prop('checked', false)
            $('.choice-tag--checked[data-' + key + '="' + itemId + '"]').removeClass('choice-tag--checked')
            location.href = '/login'
        @endif

        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            success:function(response){
                if(response.message === 'Unauthenticated.'){
                    location.href = '/login'
                }

                if(parseInt(response.status) === 1){
                    $('.follow-label[data-' + key + '="' + itemId + '"]').html('Unfollow')
                    $('.follow-button-input-tag[data-' + key + '="' + itemId + '"]').prop('checked', true).parents('label').addClass('choice-tag--checked')
                }   else{
                    $('.follow-label[data-' + key + '="' + itemId + '"]').html('Follow')
                    $('.follow-button-input-tag[data-' + key + '="' + itemId + '"]').prop('checked', false)
                    $('.choice-tag--checked[data-' + key + '="' + itemId + '"]').removeClass('choice-tag--checked')
                }
            }
        });
    })

    $(document).on('click', '.follow-button-input-user', function(){
        let url = '{{route('users.follow')}}'
        let itemId = $(this).attr('data-user-id')
        let key = 'user-id'
        let data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            userId: itemId,
        }

        @if(\Illuminate\Support\Facades\Auth::guest())
        $('.follow-label[data-' + key + '="' + itemId + '"]').html('Follow')
        $('.follow-button-input-user[data-' + key + '="' + itemId + '"]').prop('checked', false)
        $('.choice-tag--checked[data-' + key + '="' + itemId + '"]').removeClass('choice-tag--checked')
        location.href = '/login'
        @endif

        $.ajax({
            data: data,
            url: url,
            type: 'POST',
            success:function(response){
                if(response.message === 'Unauthenticated.'){
                    location.href = '/login'
                }

                if(parseInt(response.status) === 1){
                    $('.follow-label[data-' + key + '="' + itemId + '"]').html('Unfollow')
                    $('.follow-button-input-user[data-' + key + '="' + itemId + '"]').prop('checked', true).parents('label').addClass('choice-tag--checked')
                }   else{
                    $('.follow-label[data-' + key + '="' + itemId + '"]').html('Follow')
                    $('.follow-button-input-user[data-' + key + '="' + itemId + '"]').prop('checked', false)
                    $('.choice-tag--checked[data-' + key + '="' + itemId + '"]').removeClass('choice-tag--checked')
                }
            }
        });
    })
}());
</script>
