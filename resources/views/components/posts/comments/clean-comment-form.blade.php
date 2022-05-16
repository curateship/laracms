<div class="comment-form-box {{$type == 'reply' ? 'reply-box' : ''}}">

    <form class="flex gap-xs post-comment-form {{$type == 'reply' ? 'reply-form' : ''}}" method="POST" encrypt="multipart/form-data" data-item-id="{{$item_id}}" data-type="{{$type}}">
        @csrf
      <!-- Avatar -->
      <div class="comments__author-img" style="margin: 0">
          {!! \Illuminate\Support\Facades\Auth::user()->getAvatar(false, ['width' => 40, 'height' => 40])->content !!}
      </div>

      <!-- Form -->
      <div class="width-100%">
          <input type="hidden" name="itemId" value="{{$item_id}}">
        <textarea class="commentNewContent form-control width-100%" name="commentNewContent" data-type="{{$type}}" data-item-id="{{$item_id}}" placeholder="Write a comment" rows="1"></textarea>
      </div>

        <div>
            <button type="button" class="post-comment-bnt btn btn--subtle radius-lg" data-type="{{$type}}" data-item-id="{{$item_id}}" disabled>
                @if($type == 'new')
                    Post
                @endif
                @if($type == 'reply')
                    Reply
                @endif
            </button>
            @if($type == 'reply')
                <button class="cancel-reply btn btn--primary">Cancel</button>
            @endif
        </div>
    </form>

    <div class="post-result-message" data-item-id="{{$item_id}}"></div>
</div>
