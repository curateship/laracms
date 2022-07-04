@auth
<script>
(function() {

    /* Gallery media uploading */
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
        formData.append('image', $('#upload-file')[0].files[0])
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

        $('#upload-thumbnail').html('Uploading...')

        $('#uploading-progress-bar').show()

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);

                        // make sure to select the proper progress bar element - in this example we take the first available one
                        var progressBar = document.getElementsByClassName('js-progress-bar')[0];
                        // define the custom event and set the final value of the progress (70)
                        var event = new CustomEvent('updateProgress', {detail: {value: percentComplete}});
                        // dispatch the event
                        progressBar.dispatchEvent(event);

                        if(percentComplete === 100){
                            $('#upload-thumbnail').html('Data processing on the server. Please wait...')
                        }
                    }
                }, false);
                return xhr;
            },
            url : '/galleries/upload/',
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {
                if(data.thumbnail !== null){
                    $('#uploading-progress-bar').hide()

                    $('#upload-thumbnail').html(data.content)

                    $('input[name="original"]').val(data.original.path);
                    $('input[name="thumbnail"]').val(data.thumbnail.path);
                    $('input[name="medium"]').val(data.medium.path);
                    $('input[name="type"]').val(data.type);
                }
            }
        });
    }
    $(document).on('change', '#upload-file', uploadMedia);

    const editBlock = $('#js-editor-description')
    if(editBlock.length > 0){
        let readOnly = false
        let data = {}

        if(editBlock.attr('data-read-only') === 'true'){
            readOnly = true
            data = JSON.parse($('#description-json-data').val())
        }

        if(editBlock.attr('data-gallery-body') !== undefined && editBlock.attr('data-gallery-body') !== null){
            data = JSON.parse(editBlock.attr('data-gallery-body'))
        }

        editor = new EditorJS({
            holder: 'js-editor-description',
            placeholder: 'Tell your story...',
            autofocus: true,
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true,
                },
                list: {
                    class: List,
                    inlineToolbar: true,
                },
                embed: {
                    class: Embed,
                    inlineToolbar: true,
                    config: {
                        services: {
                            youtube: true,
                            coub: true
                        }
                    }
                },
                image: {
                    class: window.ImageTool,
                    config: {
                        additionalRequestHeaders: {
                            "X-CSRF-TOKEN": '{{csrf_token()}}'
                        },
                        endpoints: {
                            byFile: '/post/upload/editor',
                            byUrl: '/post/upload/editor'
                        }
                    }
                },
                extUrl: ExtMediaUrl
            },
            readOnly,
            data
        });
    }

    $(document).on('click', '.postSaveAs', function(){
        $('input[name="status"]').val($(this).attr('data-status'))

        const uploadButton = $('label[for="upload-file"]')
        if($('input[name="original"]').val() === '' || $('input[name="original"]').val() === undefined){
            uploadButton.removeClass('btn--subtle').addClass('btn--primary')

            setTimeout(function(){
                uploadButton.removeClass('btn--primary').addClass('btn--subtle')
            }, 1000)
        }   else{
            $('#new-gallery-form').submit()
        }
    })

    $(document).on('change', '#statusFilter', function(){
        if($(this).val() !== ''){
            location.href = location.pathname + '?status=' + $(this).val()
        }   else{
            location.href = location.pathname
        }

    })

    $(document).on('submit', '#new-gallery-form', function(e){
        e.preventDefault()

        const target = $($('#js-editor-description').attr('data-target-input'))

        editor.save().then((outputData) => {
            console.log(outputData);
            target.val(JSON.stringify(outputData))
        }).catch((error) => {
            console.log('Saving failed: ', error)
        });

        setTimeout(function(){
            $('#new-gallery-form')[0].submit();
        }, 200)
    });

    /* Galleries list */
    function getSelectedList(){
        let selectedGalleries = []

        // Get selected items in the list;
        $('.gallery-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedGalleries.push($(this).attr('data-gallery-id'))
            }
        })

        return selectedGalleries
    }

    function setMarkersAndFillForm(){
        const selectedGalleries = getSelectedList()

        if(selectedGalleries.length > 0){
            $('.delete-counter').html(selectedGalleries.length + ' <i class="sr-only">Notifications</i>')
            $('.move-counter').html(selectedGalleries.length + ' <i class="sr-only">Notifications</i>')

            $('.move-selected-galleries').removeClass('is-hidden')
            $('.delete-selected-galleries').removeClass('is-hidden')
        }   else{
            $('.move-selected-galleries').addClass('is-hidden')
            $('.delete-selected-galleries').addClass('is-hidden')
        }
    }

    function moveGalleriesArray(selectedGalleries){
        if(selectedGalleries.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    direction: $('.move-selected-galleries').attr('data-direction'),
                    list: selectedGalleries.join(',')
                },
                url: '{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/galleries/move',
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    function deleteGalleriesArray(selectedGalleries){
        if(selectedGalleries.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/galleries/' + selectedGalleries.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    $(document).on('click', '.gallery-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.galleries-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.move-selected-galleries', function(){
        const event = new Event('openDialog');
        document.getElementById('move-gallery-dialog').dispatchEvent(event);
        $('#move-galleries-list').val(getSelectedList().join(','))
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-galleries', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-gallery-dialog').dispatchEvent(event);
        $('#delete-galleries-list').val(getSelectedList().join(','))
    })

    // Delete from user context menu;
    $(document).on('click', '.delete-gallery-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-gallery-dialog').dispatchEvent(event);
        $('#delete-galleries-list').val($(this).attr('data-gallery-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete-galleries', function(){
        deleteGalleriesArray($('#delete-galleries-list').val().split(','))
    })

    // Move accepting from dialog;
    $(document).on('click', '#accept-move-galleries', function(){
        moveGalleriesArray($('#move-galleries-list').val().split(','))
    })

}());
</script>
@endauth
