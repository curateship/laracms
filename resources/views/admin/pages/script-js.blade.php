@auth
    <script>
        (function() {
            /* Post media uploading */
            let editor

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

                $('#new-post-form').submit()
            })

            $(document).on('submit', '#new-post-form', function(e){
                e.preventDefault()

                const target = $($('#js-editor-description').attr('data-target-input'))

                editor.save().then((outputData) => {
                    target.val(JSON.stringify(outputData))
                }).catch((error) => {
                    console.log('Saving failed: ', error)
                });

                setTimeout(function(){
                    $('#new-post-form')[0].submit();
                }, 200)
            });

            // Delete from user context menu;
            $(document).on('click', '.delete-page-context-menu', function(){
                const event = new Event('openDialog');
                document.getElementById('delete-page-dialog').dispatchEvent(event);
                $('#delete-pages-list').val($(this).attr('data-page-id'))
            })

            // Delete accepting from dialog;
            $(document).on('click', '#accept-delete-pages', function(){
                deletePagesArray($('#delete-pages-list').val().split(','), 'delete')
            })

            function deletePagesArray(selectedPosts, type){
                if(type === 'clean-trash'){
                    selectedPosts = [0];
                }

                if(selectedPosts.length > 0){
                    $.ajax({
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE',
                            type: type
                        },
                        url: '/admin/pages/' + selectedPosts.join(','),
                        type: 'POST',
                        success:function(){
                            location.reload()
                        }
                    });
                }
            }
        }())
    </script>
@endauth
