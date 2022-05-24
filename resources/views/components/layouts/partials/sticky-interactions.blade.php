<ul class="sticky-sharebar__list position-fixed position-sticky top-xs@xs padding-sm">
    <li class="padding-x-xs">

    <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus {{$user_liked ? 'comments__vote-btn--pressed' : ''}}" data-label="Like this comment along with {{$likes_count}} other people" aria-pressed="{{$user_liked ? 'true' : 'false'}}" data-post-id="{{$post->id}}">
      <div class="comments__vote-icon-wrapper">
        <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
      </div>
    </button>

    <div class="js-comments__vote-label color-contrast-low padding-left-xxxs text-sm post-likes-count" data-post-id="{{$post->id}}" aria-hidden="true">{{$likes_count}}</div>

    </li>
  </ul>
