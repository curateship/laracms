@if(session('success') || session('danger'))
<div class="modal modal--animate-translate-up modal--is-visible alert-msg flex items-end justify-end pointer-events-none js-modal" id="alert-msg-id">
  <div class="modal__content max-height-100% flex flex-column padding-md" role="alertdialog" aria-labelledby="alert-msg-title" aria-describedby="alert-msg-descr">
    <div class="margin-bottom-xxxs text-right">
      <button class="reset alert-msg__close-btn pointer-events-auto radius-full shadow-md text-sm js-modal__close js-tab-focus">
        <span>Close</span>

        <svg class="icon icon--xxs margin-left-xxxs" viewBox="0 0 12 12" aria-hidden="true" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
          <line x1="1" y1="1" x2="11" y2="11" />
          <line x1="11" y1="1" x2="1" y2="11" /></svg>
      </button>
    </div>


    <div class="pointer-events-auto width-100% max-width-xxxs padding-sm bg radius-md shadow-md overflow-auto">
      <div class="text-component text-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center">

              <svg class="icon icon--sm alert__icon margin-right-xxs" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12,0A12,12,0,1,0,24,12,12.035,12.035,0,0,0,12,0ZM10,17.414,4.586,12,6,10.586l4,4,8-8L19.414,8Z"></path>
              </svg>
              <p class="text-sm padding-top-xs">{{ session('success') != '' ? session('success') : session('danger') }}</p>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
@endif
