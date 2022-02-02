@if(session('success'))
<div class="container margin-top-xxl max-width-adaptive-lg">
  <div class="alert alert--success alert--is-visible padding-sm radius-md js-alert" role="alert">
    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <svg class="icon icon--sm alert__icon margin-right-xxs" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12,0A12,12,0,1,0,24,12,12.035,12.035,0,0,0,12,0ZM10,17.414,4.586,12,6,10.586l4,4,8-8L19.414,8Z"></path>
        </svg>

        {{ session('success') }}
      </div>
    
      <button class="reset alert__close-btn margin-left-sm js-alert__close-btn js-tab-focus">
        <svg class="icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          <title>Close alert</title>
          <line x1="3" y1="3" x2="17" y2="17" />
          <line x1="17" y1="3" x2="3" y2="17" />
        </svg>
      </button>
    </div>
  </div>
</div>
@endif