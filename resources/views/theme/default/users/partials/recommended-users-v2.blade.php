<section class="margin-bottom-lg">
    <ul class="grid-auto-md gap-md">

    @for($i = 1 ; $i <= 10 ; $i++)
    <li class="card">
        <div class="bg-light">
          <figure class="card__img img-blend corner-shadow" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="50%">
              <div class="corner top right corner-bg-darker"></div>
              <button class="reset int-table__menu-btn js-tab-focus card-menu-button" data-label="Edit row" aria-controls="menu-example">
                  <svg class="icon" viewBox="0 0 16 16">
                      <circle cx="8" cy="7.5" r="1.5" />
                      <circle cx="1.5" cy="7.5" r="1.5" />
                      <circle cx="14.5" cy="7.5" r="1.5" />
                  </svg>
              </button>
            <img class="radius-md" src="/assets/img/article-v3-img-1.jpg" alt="Card preview img">
          </figure>

          <div class="card__content card-author">
          <div class="flex">

            <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs margin-bottom-sm margin-left-xs@xs shadow-lg card-author">
              <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
            </figure>

            <div class="card-author">
              <a href="#0" class="color-inherit link-plain text-sm">Olivia Newton</a>
              <p class="text-xs color-contrast-low">@Ovliad22</p>
            </div>
            </div>

            <div class="text-component text-sm color-contrast-medium padding-bottom-xs">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, suscipit.</p>
            </div>
            
    @endfor
    </ul>
</section>

<menu id="menu-example" class="menu js-menu">
    <li role="menuitem">
      <span class="menu__content js-menu__content">
        <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
          <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
        </svg>
        <span>Edit</span>
      </span>
    </li>

    <li role="menuitem">
      <span class="menu__content js-menu__content">
        <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 16 16">
          <path d="M15,4H1C0.4,4,0,4.4,0,5v10c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V5C16,4.4,15.6,4,15,4z M14,14H2V6h12V14z"></path>
          <rect x="2" width="12" height="2"></rect>
        </svg>
        <span>Copy</span>
      </span>
    </li>

    <li role="menuitem">
      <span class="menu__content js-menu__content">
        <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
          <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
          <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
        </svg>
        <span>Delete</span>
      </span>
    </li>
  </menu>
