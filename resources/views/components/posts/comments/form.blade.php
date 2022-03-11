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
