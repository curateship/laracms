<script>
(function() {
    function getNotifications(){
        $.ajax({
            url: '{{route('notifications.get')}}',
            type: 'GET',
            success:function(request){
                $('.notification-list').html(request.content)

                if(parseInt(request.count) > 0){
                    $('.notifications-counter').show()
                    $('.notifications-counter-value').html(request.count)
                }   else{
                    $('.notifications-counter').hide()
                    $('.notifications-counter-value').html('')
                }
            }
        });
    }

    // Get notifications on page load;
    getNotifications()

    // Get notifications every 10 seconds;
    setInterval(function(){
        if($('.popover--is-visible').length === 0){
            getNotifications()
        }
    }, 10000)
/*
    $(document).on('click', '.notifications-url', function(){
        // Mark notification as read;
        const targetUrl = $(this).attr('data-url')
        const notificationId = $(this).attr('data-notification-id')

        $.ajax({
            url: '{{route('notifications.mark')}}',
            type: 'POST',
            data: {
                notificationId: notificationId
            },
            success:function(){
                location.href = targetUrl
            }
        });
    })
*/
    $(document).on('click', 'button.notifications-bell', function(){
        $.ajax({
            url: '{{route('notifications.markAll')}}',
            type: 'POST',
            success:function(){
                $('.notifications-counter').hide()
                $('.notifications-counter-value').html('')
            }
        });
    })
}());
</script>
