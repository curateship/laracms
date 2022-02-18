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

    function uploadMedia(e) {
        e.preventDefault()

        let formData = new FormData()
        formData.append('file', $('#upload-file')[0].files[0])
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

        $.ajax({
            url : '/post/upload',
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
}());
