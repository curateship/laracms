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
            readOnly,
            data
        });
    }

    $(document).on('submit', '#new-post-form', function(e){
        e.preventDefault()

        const target = $($('#js-editor-description').attr('data-target-input'))

        editor.save().then((outputData) => {
            console.log(outputData);
            target.val(JSON.stringify(outputData))
        }).catch((error) => {
            console.log('Saving failed: ', error)
        });

        setTimeout(function(){
            $('#new-post-form')[0].submit();
        }, 200)
    });

    /* Posts list */
    function getSelectedList(){
        let selectedPosts = []

        // Get selected items in the list;
        $('.post-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedPosts.push($(this).attr('data-post-id'))
            }
        })

        return selectedPosts
    }

    function setMarkersAndFillForm(){
        const selectedUsers = getSelectedList()

        $('.delete-counter').html(selectedUsers.length + ' <i class="sr-only">Notifications</i>')
    }

    function deletePostsArray(selectedPosts){
        if(selectedPosts.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '/admin/posts/' + selectedPosts.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    $(document).on('click', '.post-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.posts-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-posts', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-post-dialog').dispatchEvent(event);
        $('#delete-posts-list').val(getSelectedList().join(','))
    })

    // Delete from user context menu;
    $(document).on('click', '.delete-post-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-post-dialog').dispatchEvent(event);
        $('#delete-posts-list').val($(this).attr('data-post-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete-posts', function(){
        deletePostsArray($('#delete-posts-list').val().split(','))
    })

    /* Tags */

    $('.site-tag-pills').each(function(){
        $(this).attr('data-post-id', 123)
        select2ForTags(this);
    });

    function select2ForTags(selector){
        const postId = $(selector).attr('data-post-id')
        const placeholder = $(selector).attr('data-placeholder')

        $(selector).select2({
            ajax: {
                url: '{{route('tags.search')}}',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        postId: postId
                    }
                }
            },
            placeholder: placeholder,
            tags: true,
            tokenSeparators: [","],
            matcher: matchCustom,
            minimumInputLength: 2
        }).on('select2:opening', function(e){
            var $searchfield = $(selector).parent().find('.select2-search__field');

            if ($searchfield.val() == '')
                return false;
            else
                return true;
        }).on('select2:open', function(e){
            // $('.select2-container--open .select2-dropdown--below').css('display','none');
        }).on('select2:select', function(e) {
            validateCustomSelect(selector);
        }).on('select2:unselect', function(e) {
            validateCustomSelect(selector);
        });
    }

    function matchCustom(params, data) {
        // If there are no search terms, return null to prevent show all tags
        if ($.trim(params.term) === '') {
            return null;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
            return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.toLowerCase().indexOf(params.term) > -1) {
            var modifiedData = $.extend({}, data, true);

            // You can return modified objects from here
            // This includes matching the `children` how you want in nested data sets
            return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    function validateCustomSelect(selector) {
        if ($(selector).parents('.post-tag-wrp').length > 0) {
            $form = $(selector).parents('form')[0];
            validatePostTagFields($form);

        } else {
            if ($(selector).prop('required')) { // only when set as required field
                if ($(selector).select2('data').length == 0) {
                    $(selector).addClass('form-control--error');
                    $(selector).siblings('.select2').find('.select2-selection').addClass('form-control--error');

                } else {
                    $(selector).removeClass('form-control--error');
                    $(selector).siblings('.select2').find('.select2-selection').removeClass('form-control--error');
                }
            }
        }
    }
}());
</script>
@endauth
