<script>
    function initMangaPagination(current){
        $('#easyPaginate').remove()
        $('#easyPaginate-box').append('<ul id="easyPaginate" class="pagination"></ul>')

        $('#easyPaginate').pagination({
            total: {{$post->getGalleryLength() * 10}},
            current: parseInt(current),
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
                    refresh({
                        total: res.total,
                        length: res.length
                    });

                    $('.gallery-container').html(res.data);
                });
            }
        });
    }

    $(document).on('click', '.manga-image', function(){
        $('#easyPaginate li.active').next().children('a').trigger('click')
    })

    $(document).on('click', 'img[aria-controls="manga-modal"]', function(){
        initMangaPagination($(this).attr('data-item-key'))
    })

    initMangaPagination(1)
</script>
