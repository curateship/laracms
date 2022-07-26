@auth
<script>
(function() {
    // Ajax Upload Process
    function validateMediaUpload(formData, jqForm, options) {
        console.log('validate form before upload');
        var form = jqForm[0];

        if ( !form.media.value ) {
            alert('File not found');
            return false;
        }
    }

    function uploadMedia(type) {
        //e.preventDefault()

        let formData = new FormData()
        formData.append('image', $('#image-upload-file')[0].files[0])
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

        $.ajax({
            url : '/favorite/upload',
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {
                if(data.thumbnail !== null){
                    $('#upload-image').attr('src', data.thumbnail.path).fadeIn()

                    $('input[name="original"]').val(data.original.path);
                    $('input[name="thumbnail"]').val(data.thumbnail.path);
                    $('input[name="medium"]').val(data.medium.path);
                }
            }
        });
    }

    $(document).on('change', '#image-upload-file', function(){
        uploadMedia()
    });

    // Mass Deletes;
    function getSelectedList(){
        let selectedFavorite = []

        // Get selected items in the list;
        $('.favorite-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedFavorite.push($(this).attr('data-favorite-id'))
            }
        })

        return selectedFavorite
    }

    function setMarkersAndFillForm(){
        const selectedFavorite = getSelectedList()

        $('.delete-counter').html(selectedFavorite.length + ' <i class="sr-only">Notifications</i>')
    }

    function deleteFavoriteArray(selectedFavorite){
        if(selectedFavorite.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/favorites/' + selectedFavorite.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    $(document).on('click', '.favorite-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.favorite-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-favorite', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-favorite-dialog').dispatchEvent(event);
        $('#delete-favorite-list').val(getSelectedList().join(','))
    })

    // Delete from favorite context menu;
    $(document).on('click', '.delete-favorite-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-favorite-dialog').dispatchEvent(event);
        $('#delete-favorite-list').val($(this).attr('data-favorite-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete', function(){
        deleteFavoriteArray($('#delete-favorite-list').val().split(','))
    })

    $(document).on('click', '.postSaveAs', function(){
        $('input[name="status"]').val($(this).attr('data-status'))

        $('#favorite-form').submit()
    })
}());
</script>
@endauth
