<details class="comments__details details js-details" data-comment-id="{{$comment->id}}">
    <summary class="details__summary color-primary js-details__summary text-sm show-comment-reply-list" role="button" data-comment-id="{{$comment->id}}">
                      <span class="flex items-center">
                        <svg class="icon icon--xxs margin-right-xxs reply-arrow" data-comment-id="{{$comment->id}}"  aria-hidden="true" viewBox="0 0 12 12"><path d="M2.783.088A.5.5,0,0,0,2,.5v11a.5.5,0,0,0,.268.442A.49.49,0,0,0,2.5,12a.5.5,0,0,0,.283-.088l8-5.5a.5.5,0,0,0,0-.824Z"></path></svg>
                        <span>View
                            <span class="reply-list-count" data-comment-id="{{$comment->id}}">{{$comment->replies(true)}}</span>
                            replies</span>
                      </span>
    </summary>

    <div class="details__content js-details__content" data-comment-id="{{$comment->id}}">
        <ul>
            @if(isset($add_reply_list) && $add_reply_list)
                @include('components.posts.comments.reply-list', ['comment' => $comment])
            @endif
        </ul>
    </div>
</details>
