<script>
    (function() {
        $(document).on('click', '.contest-show-all-followers', function(){
            $('.contest-follower-avatar').each(function(key, item){
                if(key > 2){
                    $(this).show()
                }
            })

            $('.contest-show-all-followers').hide()
            $('.contest-hide-all-followers').show()
        })

        $(document).on('click', '.contest-hide-all-followers', function(){
            $('.contest-follower-avatar').each(function(key, item){
                if(key > 2){
                    $(this).hide()
                }
            })

            $('.contest-show-all-followers').show()
            $('.contest-hide-all-followers').hide()
        })

        $(document).on('click', '.follow-button-input', function(e){
            //e.preventDefault()

            const contestId = $(this).attr('data-contest-id')

            @if(\Illuminate\Support\Facades\Auth::guest())
            $('.follow-label[data-contest-id="' + contestId + '"]').html('Join Contest')
            $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', false)
            $('.choice-tag--checked[data-contest-id="' + contestId + '"]').removeClass('choice-tag--checked')
            location.href = '/login'
            @endif

            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    contestId: contestId,
                },
                url: '{{route('contest.follow')}}',
                type: 'POST',
                success:function(response){
                    if(response.message === 'Unauthenticated.'){
                        location.href = '/login'
                    }

                    getFollowers()

                    if(parseInt(response.status) === 1){
                        $('.follow-label[data-contest-id="' + contestId + '"]').html('Leave Contest')
                        $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', true)
                    }   else{
                        $('.follow-label[data-contest-id="' + contestId + '"]').html('Join Contest')
                        $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', false)
                        $('.choice-tag--checked[data-contest-id="' + contestId + '"]').removeClass('choice-tag--checked')
                    }
                }
            });
        })

        getFollowers()

        function getFollowers(){
            $.ajax({
                url: `/contests/getFollows/{{$contest->id}}`,
                type: 'GET',
                success:function(response){
                    if(parseInt(response.status) === 200){
                        $('.followers-container').html(response.result)
                    }
                }
            });
        }
    }())
</script>
