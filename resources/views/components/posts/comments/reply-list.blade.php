@foreach($reply_list as $reply)
    <li class="comments__comment comment-reply-item" data-type="reply" data-parent-comment-id="{{$reply->reply_id}}" data-comment-id="{{$reply->id}}">
        <div class="flex items-start">
            <a href="#" class="comments__author-img">
                <img class="block width-100% height-100% object-cover" src="{{ url('/storage').config('images.users_storage_path').$reply->author_thumbnail  }}" alt="Author picture">
            </a>

            <div class="comments__content margin-top-xxxs">
                <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                    <p><a href="/profiles/{{$reply->user_id}}" class="comments__author-name" rel="author">{{$reply->author_name}}</a></p>
                    <p>{{$reply->the_comment}}</p>
                </div>

                <div class="margin-top-xs text-sm">
                    <div class="flex gap-xxs items-center">
                        <!--
                        <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                            <span class="comments__vote-icon-wrapper">
                              <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                            </span>

                            <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                        </button>

                        <span class="comments__inline-divider" aria-hidden="true"></span>
                        -->

                        <div data-reply-id="{{$comment->id}}" role="button" class="comments__label-btn js-tab-focus comment-reply">Reply</div>
                        <span class="comments__inline-divider" aria-hidden="true"></span>

                        <time class="comments__time" aria-label="1 hour ago">{{$reply->created_at->diffForHumans()}}</time>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endforeach

@if($comment->replies(true, $last_comment_id) - 10 > 0)
    <button type="button" class="load-more-reply f-header__btn btn btn--subtle radius-full" data-reply-id="{{$comment->id}}">Load more reply</button>
@endif
