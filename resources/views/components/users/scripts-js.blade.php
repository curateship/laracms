<script>
    (function() {
    $(document).on('click', '#follow-button-input', function(e){
        //e.preventDefault()

        const userId = $(this).attr('data-user-id')

        @if(\Illuminate\Support\Facades\Auth::guest())
            $('.follow-label').html('Follow')
            $('.follow-button-input').prop('checked', false)
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
                    $('.follow-label').html('Unfollow')
                    $('.follow-button-input').prop('checked', true)
                }   else{
                    $('.follow-label').html('Follow')
                    $('.follow-button-input').prop('checked', false)
                }
            }
        });
    })

    $(document).on('keyup', '#userBio', function(e){
        $('#bioLength').html(300 - $(this).val().length)
    })
}());
</script>
