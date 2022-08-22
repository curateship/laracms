@if(Auth::user()->status == 'active')
    <div class="comment-form-box {{$type == 'reply' ? 'reply-box' : ''}}">
        <form class="post-comment-form {{$type == 'reply' ? 'reply-form' : ''}}" method="POST" encrypt="multipart/form-data" data-item-id="{{$item_id}}" data-type="{{$type}}">
            <fieldset>
                @csrf
                <legend class="form-legend">{{$title}}</legend>

                <div class="margin-bottom-xs">
                    <label class="sr-only" for="commentNewContent">Your comment</label>
                    <input type="hidden" name="itemId" value="{{$item_id}}">
                    <textarea class="commentNewContent form-control width-100%" name="commentNewContent" data-type="{{$type}}" data-item-id="{{$item_id}}"></textarea>
                </div>

                <div>
                    <button class="post-comment-bnt postbtn btn btn--primary" data-type="{{$type}}" data-item-id="{{$item_id}}" disabled>
                        @if($type == 'new')
                            Post comment
                        @endif
                        @if($type == 'reply')
                            Post reply
                        @endif
                    </button>
                    @if($type == 'reply')
                        <button class="cancel-reply btn btn--primary">Cancel</button>
                    @endif
                </div>
            </fieldset>
        </form>
        <div class="post-result-message" data-item-id="{{$item_id}}"></div>
    </div>
@else
    <aside class="note note--warning margin-bottom-md">
        <div class="flex items-center">
            <svg class="icon icon--md margin-right-sm" viewBox="0 0 30 30">
                <path d="M12.4 2.563L.377 24.518A3.023 3.023 0 0 0 3.006 29h23.987a3.023 3.023 0 0 0 2.632-4.477L17.66 2.569a2.992 2.992 0 0 0-5.26-.006z" fill="var(--color-warning-dark)" opacity=".25"></path>
                <path fill="none" stroke="var(--color-warning-dark)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19v-9"></path>
                <circle cx="15" cy="23.5" r="1.5" fill="var(--color-warning-dark)"></circle>
            </svg>

            <p class="note__title  color-contrast-higher"><strong>Your account is suspended</strong></p>
        </div>

        <div class="flex margin-top-xxxs">
            <!-- spacer - occupy same space of icon above 👆 -->
            <svg class="icon icon--md margin-right-sm" aria-hidden="true"></svg>

            <div class="note__content text-component">
                <!-- note content -->
                <p>You cannot write comments and create new posts.</p>
                <!-- end note content -->
            </div>
        </div>
    </aside>
@endif
