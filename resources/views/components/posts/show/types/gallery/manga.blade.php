<style>
    .gallery-preview-box{
        display: flex;
        flex-flow: wrap;
        gap: 17px;
        justify-content: center;
    }

    .gallery-preview-image{
        height: 150px;
        border-radius: 10px;
    }
</style>

<div>
    <img class="{{$image_classes}}" alt="thumbnail" src="{{$main}}" data-item-key="1" aria-controls="manga-modal">
    <div class="gallery-preview-box">
        @foreach($images as $image)
            {!! $image !!}
        @endforeach
    </div>
</div>

<div id="manga-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
    <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto bg radius-md shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
        <div class="padding-md col-15@md" id="manga-box">
            <div class="gallery-container"></div>
        </div>

        <footer class="padding-y-sm padding-x-md bg inner-glow-top shadow-md flex-shrink-0">
            <div class="manga-pagination-box">
                <div id="easyPaginate-box">
                    <ul id="easyPaginate" class="pagination"></ul>
                </div>

                <button class="manga-close reset modal__close-btn modal__close-btn--inner js-modal__close js-tab-focus">
                    <svg class="icon icon--xs" viewBox="0 0 16 16">
                        <title>Close modal window</title>
                        <g stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                            <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
                            <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
                        </g>
                    </svg>
                </button>
            </div>
        </footer>
    </div>

</div>
