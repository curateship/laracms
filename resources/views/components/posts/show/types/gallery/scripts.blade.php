<script>
    $('#easyPaginate').pagination({
        current: 1,
        prev: 'Prev',
        next: 'Next',
        ajax: function(options, refresh, $target){
            $.ajax({
                url: '/gallery/getManga',
                data:{
                    post_id: {{$post->id}},
                    current: options.current
                },
                dataType: 'json'
            }).done(function(res){
                console.log(res);
                refresh({
                    total: res.total,
                    length: res.length
                });

                $('.gallery-container').html(res.data);
            });
        }
    });

    $(document).on('click', '.manga-image', function(){
        $('#easyPaginate li.active').next().children('a').trigger('click')
    })
</script>
