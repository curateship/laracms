@auth
<script>
(function() {
    /* Post media uploading */
    let editor

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
            url : '/tags/upload',
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

    $(document).on('submit', '#new-tag-form', function(e){
        e.preventDefault()

        const target = $($('#js-editor-description').attr('data-target-input'))

        editor.save().then((outputData) => {
            console.log(outputData);
            target.val(JSON.stringify(outputData))
        }).catch((error) => {
            console.log('Saving failed: ', error)
        });

        setTimeout(function(){
            $('#new-tag-form')[0].submit();
        }, 200)
    });

    /* Posts list */
    function getSelectedList(){
        let selectedTags = []

        // Get selected items in the list;
        $('.tag-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedTags.push($(this).attr('data-tag-id'))
            }
        })

        return selectedTags
    }

    function setMarkersAndFillForm(){
        const selectedTags = getSelectedList()

        $('.delete-counter').html(selectedTags.length + ' <i class="sr-only">Notifications</i>')
    }

    function deleteTagsArray(selectedTags){
        if(selectedTags.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '/admin/tags/' + selectedTags.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    const editBlock = $('#js-editor-description')
    if(editBlock.length > 0){
        let readOnly = false
        let data = {}

        if(editBlock.attr('data-read-only') === 'true'){
            readOnly = true
            data = JSON.parse($('#description-json-data').val())
        }

        if(editBlock.attr('data-post-body') !== undefined && editBlock.attr('data-post-body') !== null){
            data = JSON.parse(editBlock.attr('data-post-body'))
        }

        editor = new EditorJS({
            holder: 'js-editor-description',
            placeholder: 'Tell your story...',
            autofocus: true,
            tools: {
                header: Header,
                list: {
                    class: List,
                    inlineToolbar: true,
                }
            },
            readOnly,
            data
        });
    }

    $(document).on('click', '.tag-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.tags-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-tags', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-tag-dialog').dispatchEvent(event);
        $('#delete-tags-list').val(getSelectedList().join(','))
    })

    // Delete from user context menu;
    $(document).on('click', '.delete-tag-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-tag-dialog').dispatchEvent(event);
        $('#delete-tags-list').val($(this).attr('data-tag-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete-tags', function(){
        deleteTagsArray($('#delete-tags-list').val().split(','))
    })
}());
</script>
@endauth
