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
        formData.append('file', $('#' + type + '-upload-file')[0].files[0])
        formData.append('type', type)
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

        $.ajax({
            url : '/user/upload',
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {
                if(data.thumbnail !== null){
                    $('#' + type + '-upload-thumbnail').attr('src', data.thumbnail.path).fadeIn()

                    $('input[name="' + type + '-original"]').val(data.original.path);
                    $('input[name="' + type + '-thumbnail"]').val(data.thumbnail.path);
                    $('input[name="' + type + '-medium"]').val(data.medium.path);

                    if(type === 'cover'){
                        $('#cover-upload-thumbnail').fadeIn()
                    }

                    if(type === 'avatar'){
                        $('#avatar-upload-thumbnail').fadeIn()
                    }
                }
            }
        });
    }

    $(document).on('change', '#avatar-upload-file', function(){
        uploadMedia('avatar')
    });

    $(document).on('change', '#cover-upload-file', function(){
        uploadMedia('cover')
    });

    // Mass Deletes;
    function getSelectedList(){
        let selectedUsers = []

        // Get selected items in the list;
        $('.user-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedUsers.push($(this).attr('data-user-id'))
            }
        })

        return selectedUsers
    }

    function setMarkersAndFillForm(){
        const selectedUsers = getSelectedList()

        $('.delete-counter').html(selectedUsers.length + ' <i class="sr-only">Notifications</i>')
    }

    function deleteUsersArray(selectedUsers, type){
        if(type === 'clean-trash'){
            selectedUsers = [0];
        }

        if(selectedUsers.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                    type: type
                },
                url: '/admin/users/' + selectedUsers.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    $(document).on('click', '.user-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.user-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-users', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-user-dialog').dispatchEvent(event);
        $('#delete-users-list').val(getSelectedList().join(','))
    })

    // Delete from user context menu;
    $(document).on('click', '.delete-user-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-user-dialog').dispatchEvent(event);
        $('#delete-users-list').val($(this).attr('data-user-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete', function(){
        deleteUsersArray($('#delete-users-list').val().split(','), 'delete')
    })

    $(document).on('click', '#accept-trash', function(){
        deleteUsersArray($('#delete-users-list').val().split(','), 'trash')
    })

    $(document).on('click', '#clean-trash', function(){
        deleteUsersArray($('#delete-users-list').val().split(','), 'clean-trash')
    })

    $(document).on('click', '#clean-avatar', function(){
        $('input[name="avatar-original"]').val('')
        $('input[name="avatar-thumbnail"]').val('')
        $('input[name="avatar-medium"]').val('')
        $('#avatar-upload-thumbnail').attr('src', '').css('display', 'none')
    })

    $(document).on('click', '#clean-cover', function(){
        $('input[name="cover-original"]').val('')
        $('input[name="cover-thumbnail"]').val('')
        $('input[name="cover-medium"]').val('')
        $('#cover-upload-thumbnail').attr('src', '').css('display', 'none')
    })

    $(document).on('change', '#statusFilter', function(){
        if($(this).val() !== ''){
            location.href = location.pathname + '?status=' + $(this).val()
        }   else{
            location.href = location.pathname
        }

    })

    @if(Gate::allows('is-admin'))
        $(document).on('click', '#restore-user-from-trash', function(){
            const userId = $(this).attr('data-user-id')

            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    userId: userId
                },
                url: '/users/restoreFromTrash',
                type: 'POST',
                success:function(data){
                    if(data.status === 200){
                        location.reload()
                    }
                }
            });
        })
    @endif

}());
</script>
@endauth
