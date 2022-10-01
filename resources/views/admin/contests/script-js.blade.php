@auth
    <script>
        (function() {
            $(document).on('click', '.contest-show-all-followers', function(){
                $('.contest-follower-avatar').each(function(key, item){
                    if(key > 2){
                        $(this).show()
                    }
                })

                $('.contest-show-all-followers').hide()
                $('.contest-hide-all-followers').show()
            })

            $(document).on('click', '.contest-hide-all-followers', function(){
                $('.contest-follower-avatar').each(function(key, item){
                    if(key > 2){
                        $(this).hide()
                    }
                })

                $('.contest-show-all-followers').show()
                $('.contest-hide-all-followers').hide()
            })

            $(document).on('click', '.follow-button-input', function(e){
                //e.preventDefault()

                const contestId = $(this).attr('data-contest-id')

                @if(\Illuminate\Support\Facades\Auth::guest())
                $('.follow-label[data-contest-id="' + contestId + '"]').html('Join Contest')
                $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', false)
                $('.choice-tag--checked[data-contest-id="' + contestId + '"]').removeClass('choice-tag--checked')
                location.href = '/login'
                @endif

                $.ajax({
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        contestId: contestId,
                    },
                    url: '{{route('contest.follow')}}',
                    type: 'POST',
                    success:function(response){
                        if(response.message === 'Unauthenticated.'){
                            location.href = '/login'
                        }

                        getFollowers()

                        if(parseInt(response.status) === 1){
                            $('.follow-label[data-contest-id="' + contestId + '"]').html('Leave Contest')
                            $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', true)
                        }   else{
                            $('.follow-label[data-contest-id="' + contestId + '"]').html('Join Contest')
                            $('.follow-button-input[data-contest-id="' + contestId + '"]').prop('checked', false)
                            $('.choice-tag--checked[data-contest-id="' + contestId + '"]').removeClass('choice-tag--checked')
                        }
                    }
                });
            })

            getFollowers()

            function getFollowers(){
                $.ajax({
                    url: `/contests/getFollows/{{$contest->id}}`,
                    type: 'GET',
                    success:function(response){
                        if(parseInt(response.status) === 200){
                            $('.followers-container').html(response.result)
                        }
                    }
                });
            }

            /* Post media uploading */
            let editor

            function uploadMedia(e) {
                e.preventDefault()

                let formData = new FormData()
                formData.append('image', $('#upload-file')[0].files[0])
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'))

                $.ajax({
                    url : '/contests/upload/main',
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
            $(document).on('click', '.delete-contest-context-menu', function(){
                const event = new Event('openDialog');
                document.getElementById('delete-contest-dialog').dispatchEvent(event);
                $('#delete-contests-list').val($(this).attr('data-contest-id'))
            })

            // Delete accepting from dialog;
            $(document).on('click', '#accept-delete-contests', function(){
                deleteContestsArray($('#delete-contests-list').val().split(','), 'delete')
            })

            $(document).on('change', '#statusFilter', function(){
                if($(this).val() !== ''){
                    location.href = location.pathname + '?status=' + $(this).val()
                }   else{
                    location.href = location.pathname
                }

            })

            function deleteContestsArray(selectedPosts, type){
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
                        url: '/admin/contests/' + selectedPosts.join(','),
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
