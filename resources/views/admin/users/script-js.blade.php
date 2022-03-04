@auth
<script>
(function() {
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

    function deleteUsersArray(selectedUsers){
        if(selectedUsers.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
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
        deleteUsersArray($('#delete-users-list').val().split(','))
    })
}());
</script>
@endauth
