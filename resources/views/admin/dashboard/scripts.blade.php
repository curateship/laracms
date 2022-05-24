<script>
    getBadges()

    function updateCounters(){
        $('.dashboard-counter').each(function(){
            if(parseInt($(this).html()) === 0){
                $(this).hide()
            }   else{
                $(this).show()
            }
        })
    }

    function getBadges(){
        $.ajax({
            url: '/dashboard/getListBadges',
            type: 'GET',
            success:function(response){
                Object.keys(response).forEach(function(type){
                    $('.dashboard-counter[data-target="' + type + '"]').html(response[type])
                })
                updateCounters()
            }
        });
    }
</script>
