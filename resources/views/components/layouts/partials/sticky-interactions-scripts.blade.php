@auth
    <script>
        function getCreateForm(){
            $.ajax({
                url: '/favorite/getListCreateForm',
                type: 'GET',
                success:function(response){
                    if(parseInt(response.status) === 200){
                        $('#lists-search').hide()
                        $('#lists-box-content').html(response.data)
                    }
                }
            });
        }

        function getFavList(search){
            $.ajax({
                url: '/favorite/getList',
                type: 'GET',
                data: {
                    postId: {{$post->id}},
                    search: search
                },
                success:function(response){

                    if(parseInt(response.status) === 200){
                        $('#lists-search').show()
                        $('#lists-box-content').html(response.data)
                    }
                }
            });
        }

        $(document).on('keyup', '#lists-search', function(){
            getFavList($(this).val())
        })

        $(document).on('click', '.add-new-favorite-button', function(){
            getCreateForm()
        })

        $(document).on('click', '.add-new-favorite-button-cancel', function(){
            getFavList()
        })

        $(document).on('click', '.select-template-for-add', function(){
            const postId = {{$post->id}};
            const listItemId = $(this).attr('data-list-id')

            $.ajax({
                url : '/favorite/addItem',
                type : 'POST',
                data : {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    postId: postId,
                    listId: listItemId
                },
                success : function(data) {
                    if(parseInt(data.status) === 200){
                        let event = new Event('closeModal');
                        document.getElementById('modal-explorer').dispatchEvent(event);

                        $('.post-lists-count[data-post-id="' + postId + '"]').html(data.lists_count)

                        if(data.user_listed){
                            $('.js-comments__vote-btn-favorite').addClass('comments__vote-btn--pressed')
                        }   else{
                            $('.js-comments__vote-btn-favorite').removeClass('comments__vote-btn--pressed')
                        }
                    }
                }
            });
        })

        $(document).on('click', '.js-comments__vote-btn-favorite', function(){
            getFavList()
        })

        $(document).on('click', '.remove-fav-list', function(){
            if(confirm("Did you really want to remove selected list?")){
                const listItemId = $(this).attr('data-list-id')

                $.ajax({
                    url : '/favorite/removeList',
                    type : 'POST',
                    data : {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        listId: listItemId
                    },
                    success : function(data) {
                        if(parseInt(data.status) === 200){
                            getFavList()
                        }
                    }
                });
            }
        })

        $(document).on('click', '#create-new-list', function(){
            const title = $('#new-favorite-name').val()
            const images = {
                original: $('input[name="original"]').val(),
                thumbnail: $('input[name="thumbnail"]').val(),
                medium: $('input[name="medium"]').val()
            }

            if(title === ''){
                alert('Title for new list cannot be empty')
                return false
            }

            if(images.original === ''){
                alert('You must upload image for new list')
                return false
            }

            $.ajax({
                url : '/favorite/create',
                type : 'POST',
                data : {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: title,
                    images: images
                },
                success : function(data) {
                    if(parseInt(data.status) === 200){
                        $('.add-new-favorite').hide()
                        $('.explorer__results').show()
                        $('.favorite-search-block').show()
                        getFavList()
                    }
                }
            });
        })

        function uploadMedia(e) {
            e.preventDefault()

            let formData = new FormData()
            formData.append('image', $('#upload-file')[0].files[0])
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

            $.ajax({
                url : '/favorite/upload/main',
                type : 'POST',
                data : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success : function(data) {
                    if(data.thumbnail !== null){
                        $('#upload-thumbnail').attr('src', data.thumbnail.path).fadeIn()

                        $('input[name="original"]').val(data.original.path);
                        $('input[name="thumbnail"]').val(data.thumbnail.path);
                        $('input[name="medium"]').val(data.medium.path);
                    }
                }
            });
        }
        $(document).on('change', '#upload-file', uploadMedia);

        getFavList()
    </script>
@endauth
