@auth
<script>
(function() {
    function getSelectedList(){
        let selectedComments = []

        // Get selected items in the list;
        $('.comment-list-checkbox').each(function(){
            if($(this).prop('checked')){
                selectedComments.push($(this).attr('data-comment-id'))
            }
        })

        return selectedComments
    }

    function setMarkersAndFillForm(){
        const selectedComments = getSelectedList()

        $('.delete-counter').html(selectedComments.length + ' <i class="sr-only">Notifications</i>')
    }

    function deleteCommentsArray(selectedComments){
        if(selectedComments.length > 0){
            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'DELETE',
                },
                url: '/admin/comments/' + selectedComments.join(','),
                type: 'POST',
                success:function(){
                    location.reload()
                }
            });
        }
    }

    $(document).on('click', '.comment-list-checkbox', function(){
        setMarkersAndFillForm()
    })

    $(document).on('click', '.comments-list-checkbox-all', function(){
        setMarkersAndFillForm()
    })

    // Delete from delete button;
    $(document).on('click', '.delete-selected-comments', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-comment-dialog').dispatchEvent(event);
        $('#delete-comments-list').val(getSelectedList().join(','))
    })

    // Delete from user context menu;
    $(document).on('click', '.delete-comment-context-menu', function(){
        const event = new Event('openDialog');
        document.getElementById('delete-comment-dialog').dispatchEvent(event);
        $('#delete-comments-list').val($(this).attr('data-comment-id'))
    })

    // Delete accepting from dialog;
    $(document).on('click', '#accept-delete', function(){
        deleteCommentsArray($('#delete-comments-list').val().split(','))
    })
}());
</script>
@endauth
