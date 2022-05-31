@push('custom-scripts')
    @include('components.posts.comments.scripts-js')
    @include('components.posts.likes.scripts-js')
    @include('components.posts.lists.infinite-posts.script-infinite-scroll')
    @include('components.posts.lists.infinite-posts.scripts')
@endpush

<!-- Delete Confirmation -->
<div id="delete-post-dialog" class="dialog dialog--sticky js-dialog" data-animation="on">
    <div class="dialog__content max-width-xxs" role="alertdialog" aria-labelledby="dialog-sticky-title" aria-describedby="dialog-sticky-description">
        <div class="text-component">
            <h4 id="dialog-sticky-title">Are you sure what you want to delete selected post(-s)?</h4>
        </div>
        <footer class="margin-top-md">
            <div class="flex justify-end gap-xs flex-wrap">
                <button class="btn btn--subtle js-dialog__close">Cancel</button>
                <button id="accept-delete-posts" class="btn btn--accent">Delete</button>
            </div>
        </footer>
        <input type="hidden" id="delete-posts-list">
    </div>
</div>

<div class="infinite-posts-list" data-type="all"></div>
