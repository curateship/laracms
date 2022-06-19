@push('custom-scripts')
    @include('components.layouts.partials.sticky-interactions-scripts')
@endpush

<ul class="sticky-sharebar__list position-fixed position-sticky top-xs@xs padding-sm">
    <li class="padding-x-xs">
        <button class="reset comments__vote-btn js-comments__vote-btn-like js-tab-focus {{$user_liked ? 'comments__vote-btn--pressed' : ''}}" data-label="Like this comment along with {{$likes_count}} other people" aria-pressed="{{$user_liked ? 'true' : 'false'}}" data-post-id="{{$post->id}}">
            <div class="comments__vote-icon-wrapper">
                <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
            </div>
        </button>
        <div class="js-comments__vote-label color-contrast-low padding-left-xxxs text-sm post-likes-count" data-post-id="{{$post->id}}" aria-hidden="true">{{$likes_count}}</div>
    </li>

    <!-- List -->
    <li class="padding-x-xs margin-top-sm">
        <button class="reset comments__vote-btn js-comments__vote-btn-favorite js-tab-focus {{$user_listed ? 'comments__vote-btn--pressed' : ''}}" aria-controls="modal-explorer">
            <div class="comments__vote-icon-wrapper">
                <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M4.94 9.12a3.79 3.79 0 0 1 5.74-3.26l1.16-1.14a0.4 0.4 0 0 0-0.22-0.68l-3.65-0.53-1.63-3.31a0.42 0.42 0 0 0-0.72 0l-1.63 3.31-3.65 0.53a0.4 0.4 0 0 0-0.22 0.68l2.64 2.58-0.62 3.63a0.4 0.4 0 0 0 0.58 0.42l2.36-1.24a3.78 3.78 0 0 1-0.14-0.99z"></path><path d="M8.74 6.08a3.04 3.04 0 1 0 3.04 3.04 3.04 3.04 0 0 0-3.04-3.04z m1.52 4.18h-3.04v-0.76h3.04z m0-1.52h-3.04v-0.76h3.04z"></path></svg>
            </div>
        </button>
        <div class="js-comments__vote-label color-contrast-low padding-left-xxxs text-sm post-lists-count" data-post-id="{{$post->id}}" aria-hidden="true">{{$lists_count}}</div>
    </li>
</ul>

<!-- List Modal -->
<div class="modal modal--animate-fade bg-black bg-opacity-90% padding-x-md padding-y-lg js-modal" id="modal-explorer">
    <div class="modal__content explorer width-100% max-width-xs max-height-100% overflow-auto margin-x-auto flex flex-column bg radius-md shadow-md">

        <div class="explorer__input-wrapper flex-shrink-0">
            <input id="lists-search" class="reset explorer__input width-100%" type="text" placeholder="Search Lists..." autocomplete="off" role="combobox">

            <div class="explorer__loader position-absolute top-0 right-0 padding-right-sm height-100% flex items-center" aria-hidden="true" style="display: none;">
                <div class="circle-loader circle-loader--v1">
                    <div class="circle-loader__circle"></div>
                </div>
            </div>
        </div>

        <div id="lists-box-content">

        </div>
    </div>

    <button class="reset modal__close-btn modal__close-btn--outer display@md js-modal__close js-tab-focus">
        <svg class="icon icon--sm" viewBox="0 0 24 24"><title>Close modal window</title><g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="3" x2="21" y2="21"/><line x1="21" y1="3" x2="3" y2="21"/></g></svg>
    </button>
</div>
