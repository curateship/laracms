<section class="margin-bottom-lg">
    <ul class="grid-auto-md gap-md">

        @for($i = 1 ; $i <= 5 ; $i++)
            <li class="card">
                <div class="bg-light radius-md">
                    <figure class="card__img card-user corner-shadow">
                        <div class="corner top right corner-bg-darker"></div>
                        <button class="reset int-table__menu-btn js-tab-focus card-menu-button" data-label="Edit row" aria-controls="menu-example">
                            <svg class="icon" viewBox="0 0 16 16">
                                <circle cx="8" cy="7.5" r="1.5" />
                                <circle cx="1.5" cy="7.5" r="1.5" />
                                <circle cx="14.5" cy="7.5" r="1.5" />
                            </svg>
                        </button>

                        <div class="card__content card-user-content">
                            <div class="flex">
                                <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs margin-bottom-sm margin-left-xs@xs shadow-md">
                                    <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
                                </figure>
                                <div class="">
                                    <a href="#0" class="color-inherit link-plain text-sm">Olivia Newton</a>
                                    <p class="text-xs color-inherit">@Ovliad22</p>
                                </div>
                            </div>

                            <div class="text-component text-sm color-inherit padding-bottom-xs">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, suscipit.</p>
                            </div>
                        </div>
                        <div class="card-body img-blend" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="50%">
                            <img class="radius-md" src="/assets/img/article-v3-img-1.jpg" alt="Card preview img">
                        </div>
                    </figure>

                    <footer class="card-v10__footer">
                        <ul class="card-v10__social-list">
                            <li class="card-v10__social-item">
                                <button class="reset card-v10__social-btn js-tab-focus" aria-label="Like this content along with 120 other people">
                                    <svg class="icon" viewBox="0 0 12 12">
                                        <g>
                                            <path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path>
                                        </g>
                                    </svg>

                                    <span>120</span>
                                </button>
                            </li>

                            <li class="card-v10__social-item">
                                <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                                    <svg class="icon" viewBox="0 0 12 12">
                                        <g>
                                            <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                                        </g>
                                    </svg>

                                    <span>32</span>
                                </button>
                            </li>

                            <li class="card-v10__social-item">
                                <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                                    <svg class="icon" viewBox="0 0 12 12">
                                        <g>
                                            <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                                        </g>
                                    </svg>

                                    <span>32</span>
                                </button>
                            </li>

                        </ul>
                    </footer>
                </div>
            </li>
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
