@foreach($comments as $comment)
        <li class="comments__comment" data-type="comment" data-comment-id="{{$comment->id}}">
            <div class="flex items-start margin-bottom-sm">
                <a href="/user/{{$comment->author->username}}" class="comments__author-img">
                    {!! $comment->author->getAvatar(false, ['width' => 45, 'height' => 45], ['block', 'width-100%', 'height-100%', 'object-cover'])->content !!}
                </a>

                <div class="comments__content margin-top-xxxs">
                    <div class="text-component text-sm text-space-y-xs line-height-sm js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                        <p><a href="/user/{{$comment->author->username}}" class="comments__author-name" rel="author">{{$comment->author->name}}</a></p>
                        <p>{{$comment->the_comment}}</p>
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

                            @auth
                                <div data-reply-id="{{$comment->id}}" role="button" class="comments__label-btn js-tab-focus comment-reply">Reply</div>
                                <span class="comments__inline-divider" aria-hidden="true"></span>
                            @endauth

                            <!--
                            <div class="reset comments__label-btn js-tab-focus" aria-controls="popover-example">Report</div>

                            <div id="popover-example" class="popover bg-light padding-sm radius-md inner-glow shadow-md js-popover js-tab-focus" role="dialog">
                                <div class="text-component text-md">

                                    <fieldset class="margin-bottom-md">

                                        <p class="text-xs">Help us keep the community clean</p>
                                        <ul class="flex flex-column list">

                                            <li>
                                                <input class="radio" type="radio" name="radio-button" id="radio-1" checked>
                                                <label for="radio-1">Spam</label>
                                            </li>

                                            <li>
                                                <input class="radio" type="radio" name="radio-button" id="radio-2">
                                                <label for="radio-2">Inappropriate</label>
                                            </li>

                                        </ul>
                                    </fieldset>
                                    <button class="margin-left-sm btn btn--primary">Report</button>

                                </div>
                            </div>
                            <span class="comments__inline-divider" aria-hidden="true"></span>
                            -->

                            <time class="comments__time" aria-label="1 hour ago">{{$comment->created_at->diffForHumans()}}</time>
                        </div>
                        @if($comment->created_at != $comment->updated_at)
                            <div class="edited-comment">Comment was be edited.</div>
                        @endif
                    </div>
                </div>
            </div>
        </li>

        @if($comment->replies(true))
            @include('components.posts.comments.reply-box', ['comment' => $comment])
        @endif

@endforeach

@if($post->existMoreComments($last_comment_id) - 10 > 0)
    <button type="button" class="load-more-comments f-header__btn btn btn--subtle radius-full" data-post-id="{{$post->id}}">Load more comments</button>
@endif
