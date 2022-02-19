(function() {
    function getSelectedList(){
        let selectedUsers = []

        // Get selected items in the list;
        $('.post-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedUsers.push($(this).attr('data-post-id'))
            }
        })

        return selectedUsers
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
}());
