<script>
    (function() {
    $(document).on('click', '.follow-button-input', function(e){
        //e.preventDefault()

        const userId = $(this).attr('data-user-id')

        @if(\Illuminate\Support\Facades\Auth::guest())
            $('.follow-label[data-user-id="' + userId + '"]').html('Follow')
            $('.follow-button-input[data-user-id="' + userId + '"]').prop('checked', false)
            $('.choice-tag--checked[data-user-id="' + userId + '"]').removeClass('choice-tag--checked')
            location.href = '/login'
        @endif

        $.ajax({
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                userId: userId,
            },
            url: '{{route('users.follow')}}',
            type: 'POST',
            success:function(response){
                if(response.message === 'Unauthenticated.'){
                    location.href = '/login'
                }

                if(parseInt(response.status) === 1){
                    $('.follow-label[data-user-id="' + userId + '"]').html('Unfollow')
                    $('.follow-button-input[data-user-id="' + userId + '"]').prop('checked', true)
                }   else{
                    $('.follow-label[data-user-id="' + userId + '"]').html('Follow')
                    $('.follow-button-input[data-user-id="' + userId + '"]').prop('checked', false)
                    $('.choice-tag--checked[data-user-id="' + userId + '"]').removeClass('choice-tag--checked')
                }
            }
        });
    })

    $(document).on('keyup', '#userBio', function(e){
        $('#bioLength').html(300 - $(this).val().length)
    })

    $(document).on('click', '#clean-avatar', function(){
        $('input[name="avatar-original"]').val('')
        $('input[name="avatar-thumbnail"]').val('')
        $('input[name="avatar-medium"]').val('')
        $('#avatar-upload-thumbnail').attr('src', '').css('display', 'none')
    })

        $(document).on('click', '#clean-cover', function(){
            $('input[name="cover-original"]').val('')
            $('input[name="cover-thumbnail"]').val('')
            $('input[name="cover-medium"]').val('')
            $('#cover-upload-thumbnail').attr('src', '').css('display', 'none')
        })
}());
</script>
