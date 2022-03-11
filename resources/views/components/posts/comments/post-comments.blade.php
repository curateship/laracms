@foreach($post->comments as $comment)
        <li class="comments__comment">
            <div class="flex items-start margin-bottom-sm">
                <a href="#" class="comments__author-img">
                    <img class="block width-100% height-100% object-cover" src="{{ url('/storage').config('images.users_storage_path').$comment->user()->thumbnail  }}" alt="Author picture">
                </a>

                <div class="comments__content margin-top-xxxs">
                    <div class="text-component text-sm text-space-y-xs line-height-sm js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                        <p><a href="#" class="comments__author-name" rel="author">{{$comment->user()->name}}</a></p>
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
                    </div>
                </div>
            </div>
        </li>

        @if(count($comment->replies()) > 0)
            <details class="comments__details details js-details">
                <summary class="details__summary color-primary js-details__summary text-sm" role="button">
                      <span class="flex items-center">
                        <svg class="icon icon--xxs margin-right-xxs" aria-hidden="true" viewBox="0 0 12 12"><path d="M2.783.088A.5.5,0,0,0,2,.5v11a.5.5,0,0,0,.268.442A.49.49,0,0,0,2.5,12a.5.5,0,0,0,.283-.088l8-5.5a.5.5,0,0,0,0-.824Z"></path></svg>
                        <span>View {{count($comment->replies())}} replies</span>
                      </span>
                </summary>

                <div class="details__content js-details__content">
                    <ul>
                        @foreach($comment->replies() as $reply)
                            <li class="comments__comment">
                                <div class="flex items-start">
                                    <a href="#" class="comments__author-img">
                                        <img class="block width-100% height-100% object-cover" src="{{ url('/storage').config('images.users_storage_path').$reply->user()->thumbnail  }}" alt="Author picture">
                                    </a>

                                    <div class="comments__content margin-top-xxxs">
                                        <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                                            <p><a href="#" class="comments__author-name" rel="author">{{$reply->user()->name}}</a></p>
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
                    </ul>
                </div>
            </details>
        @endif

@endforeach
