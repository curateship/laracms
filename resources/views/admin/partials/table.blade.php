<!-- Content Table Column -->
<div class="col-12@md">
    <div class="card">
        <div class="int-table-actions padding-bottom-xxxs" data-table-controls="table-1">

            <!-- Control Bar -->
              <div class="controlbar--sticky flex justify-between">
                <div class="margin-xs">
                  <div class="inline-flex items-baseline">
                    <h1 class="text-md color-contrast-high margin-x-xs" for="filterItems">Posts</h1>
                  </div>
                </div>
                <!-- END Control Bar-->

                <!-- Menu Bar -->
                <div class="flex flex-wrap items-center justify-between margin-right-xxs">
                  <div class="flex flex-wrap">

                  <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">
                    <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                        <circle cx="8" cy="7.5" r="1.5" />
                        <circle cx="1.5" cy="7.5" r="1.5" />
                        <circle cx="14.5" cy="7.5" r="1.5" /></svg>
                    </li>

                   <li class="menu-bar__item" role="menuitem" aria-controls="create-modal">
                   <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                      <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
                    </svg>
                    <span class="menu-bar__label">Add Post</span>
                  </li>

                  <li class="menu-bar__item" role="menuitem" aria-controls="modal-search">
                    <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                      <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
                    </svg>
                    <span class="menu-bar__label">Search Posts</span>
                  </li>
                </menu>

                <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar">
                  <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                    <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <circle cx="8" cy="7.5" r="1.5" />
                      <circle cx="1.5" cy="7.5" r="1.5" />
                      <circle cx="14.5" cy="7.5" r="1.5" /></svg>
                  </li>

                  <li class="menu-bar__item" role="menuitem">
                    <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g>
                        <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                        <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                        </g>
                      </svg>
                      <span class="counter counter--critical counter--docked">4 <i class="sr-only">Notifications</i></span>
                      <span class="menu-bar__label">Delete</span>
                  </li>
                </menu>

              </div>
                </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
                  </div>
              <!-- END Control Bar-->

            <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->

            <!-- Table-->
            <div class="padding-sm">
              <div id="table-1" class="int-table text-sm js-int-table">
                <div class="int-table__inner">
                  <table class="int-table__table" aria-label="Interactive table example">
                    <thead class="js-int-table__header">
                      <tr class="int-table__row">
                        <td class="int-table__cell">
                          <div class="custom-checkbox int-table__checkbox">
                            <input class="custom-checkbox__input js-int-table__select-all" type="checkbox" aria-label="Select all rows" />
                            <div class="custom-checkbox__control" aria-hidden="true"></div>
                          </div>
                        </td>
              
                        <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
                          <div class="flex items-center">
                            <span>ID</span>
              
                            <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                              <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                              <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                          </div>
              
                          <ul class="sr-only js-int-table__sort-list">
                            <li>
                              <input type="radio" name="sortingId" id="sortingIdNone" value="none" checked>
                              <label for="sortingIdNone">No sorting</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingId" id="sortingIdAsc" value="asc">
                              <label for="sortingIdAsc">Sort in ascending order</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingId" id="sortingIdDes" value="desc">
                              <label for="sortingIdDes">Sort in descending order</label>
                            </li>
                          </ul>
                        </th>
              
                        <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
                          <div class="flex items-center">
                            <span>Name</span>
              
                            <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                              <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                              <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                          </div>
              
                          <ul class="sr-only js-int-table__sort-list">
                            <li>
                              <input type="radio" name="sortingName" id="sortingNameNone" value="none" checked>
                              <label for="sortingNameNone">No sorting</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingName" id="sortingNameAsc" value="asc">
                              <label for="sortingNameAsc">Sort in ascending order</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingName" id="sortingNameDes" value="desc">
                              <label for="sortingNameDes">Sort in descending order</label>
                            </li>
                          </ul>
                        </th>
              
                        <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
                          <div class="flex items-center">
                            <span>Status</span>
              
                            <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                              <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                              <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                          </div>
              
                          <ul class="sr-only js-int-table__sort-list">
                            <li>
                              <input type="radio" name="sortingEmail" id="sortingEmailNone" value="none" checked>
                              <label for="sortingEmailNone">No sorting</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingEmail" id="sortingEmailAsc" value="asc">
                              <label for="sortingEmailAsc">Sort in ascending order</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingEmail" id="sortingEmailDes" value="desc">
                              <label for="sortingEmailDes">Sort in descending order</label>
                            </li>
                          </ul>
                        </th>
              
                        <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort" data-date-format="dd-mm-yyyy">
                          <div class="flex items-center">
                            <span>Date</span>
              
                            <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                              <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                              <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                          </div>
              
                          <ul class="sr-only js-int-table__sort-list">
                            <li>
                              <input type="radio" name="sortingDate" id="sortingDateNone" value="none" checked>
                              <label for="sortingDateNone">No sorting</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingDate" id="sortingDateAsc" value="asc">
                              <label for="sortingDateAsc">Sort in ascending order</label>
                            </li>
              
                            <li>
                              <input type="radio" name="sortingDate" id="sortingDateDes" value="desc">
                              <label for="sortingDateDes">Sort in descending order</label>
                            </li>
                          </ul>
                        </th>
              
                        <th class="int-table__cell int-table__cell--th text-left">Preview</th>
                        <th class="int-table__cell int-table__cell--th text-right">Action</th>
                      </tr>
                    </thead>
              
                    <tbody class="int-table__body js-int-table__body">
              
                      <tr class="int-table__row">
                        <th class="int-table__cell" scope="row">
                          <div class="custom-checkbox int-table__checkbox">
                            <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" />
                            <div class="custom-checkbox__control" aria-hidden="true"></div>
                          </div>
                        </th>
                        <td class="int-table__cell">1</td>
                        <td class="int-table__cell" aria-controls="edit-modal"><a href="#0">Template Name 1</a></td>
                        <td class="int-table__cell">Published</td>
                        <td class="int-table__cell">01/01/2020</td>
                        <td class="int-table__cell"><button class="btn btn--primary" aria-controls="preview-modal">Preview</button></td>
                        <td class="int-table__cell">
                          <button class="reset int-table__menu-btn margin-left-auto">
                            <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16" aria-controls="dialog">
                              <g>
                                <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                                <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                              </g>
                           </svg>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- END Table-->

          </div>
        </div>
      </div>
<!-- END Content Body Wrapper -->

<!-- Create Modal -->
<div id="create-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Modal title</h1>

      <button class="reset modal__close-btn modal__close-btn--inner js-modal__close js-tab-focus">
        <svg class="icon icon--xs" viewBox="0 0 16 16">
          <title>Close modal window</title>
          <g stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
            <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
            <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
          </g>
        </svg>
      </button>
    </header>

    <div class="padding-md col-15@md">
          <form>
            <fieldset class="margin-bottom-md">

              <div class="margin-bottom-xs">
                <label class="form-label margin-bottom-xxs" for="inputEmail">Email</label>
                <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="email@myemail.com">
              </div>
      
              <div>
                <label class="form-label margin-bottom-xxs" for="textarea">Textarea</label>
                <textarea class="form-control width-100%" name="textarea" id="textarea"></textarea>
                <p class="text-xs color-contrast-medium margin-top-xxs">Use helper text to provide additional information.</p>
              </div>
            </fieldset>
          
            <fieldset class="margin-bottom-md">
              <legend class="form-legend">Checkboxes</legend>
          
              <div class="flex flex-wrap gap-md">
                <div>
                  <input class="checkbox" type="checkbox" id="checkbox1">
                  <label for="checkbox1">Option 1</label>
                </div>
          
                <div>
                  <input class="checkbox" type="checkbox" id="checkbox2">
                  <label for="checkbox2">Option 2</label>
                </div>
              </div>
              
            </fieldset>
          
          </form>
        </div>

    <footer class="padding-y-sm padding-x-md bg inner-glow-top shadow-md flex-shrink-0">
      <div class="flex justify-end gap-xs">
        <button class="btn btn--subtle js-modal__close">Cancel</button>
        <button class="btn btn--primary">Install</button>
      </div>
    </footer>
  </div>

</div>
<!-- Create Modal END -->

<!-- Edit Modal -->
<div id="edit-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Modal title</h1>

      <button class="reset modal__close-btn modal__close-btn--inner js-modal__close js-tab-focus">
        <svg class="icon icon--xs" viewBox="0 0 16 16">
          <title>Close modal window</title>
          <g stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
            <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
            <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
          </g>
        </svg>
      </button>
    </header>

    <div class="padding-md col-15@md">
          <form>
            <fieldset class="margin-bottom-md">

              <div class="margin-bottom-xs">
                <label class="form-label margin-bottom-xxs" for="inputEmail">Email</label>
                <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="email@myemail.com">
              </div>
      
              <div>
                <label class="form-label margin-bottom-xxs" for="textarea">Textarea</label>
                <textarea class="form-control width-100%" name="textarea" id="textarea"></textarea>
                <p class="text-xs color-contrast-medium margin-top-xxs">Use helper text to provide additional information.</p>
              </div>
            </fieldset>
          
            <fieldset class="margin-bottom-md">
              <legend class="form-legend">Checkboxes</legend>
          
              <div class="flex flex-wrap gap-md">
                <div>
                  <input class="checkbox" type="checkbox" id="checkbox1">
                  <label for="checkbox1">Option 1</label>
                </div>
          
                <div>
                  <input class="checkbox" type="checkbox" id="checkbox2">
                  <label for="checkbox2">Option 2</label>
                </div>
              </div>
              
            </fieldset>
          
          </form>
        </div>

    <footer class="padding-y-sm padding-x-md bg inner-glow-top shadow-md flex-shrink-0">
      <div class="flex justify-end gap-xs">
        <button class="btn btn--primary">Save</button>
      </div>
    </footer>
  </div>

</div>
<!-- Edit Modal END -->

<!-- Modal Search-->
<div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="modal-search">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
    <form class="full-screen-search">
      <label for="search-input-x" id="modal-search-title" class="sr-only">Search</label>
      <input class="reset full-screen-search__input" type="search" name="search-input-x" id="search-input-x" placeholder="Search...">
      <button class="reset full-screen-search__btn">
        <svg class="icon" viewBox="0 0 24 24">
          <title>Search</title>
          <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
            <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
            <circle cx="10" cy="10" r="8"></circle>
          </g>
        </svg>
      </button>
    </form>
  </div>

  <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
</div>
<!-- Modal Search END -->

<!-- Confirmation Dialog-->
<div id="dialog" class="dialog dialog--sticky js-dialog" data-animation="on">
  <div class="dialog__content max-width-xxs" role="alertdialog" aria-labelledby="dialog-sticky-title" aria-describedby="dialog-sticky-description">
    <div class="text-component">
      <h4 id="dialog-sticky-title">Are you sure you want to permanently delete this file?</h4>
      <p id="dialog-sticky-description">This action cannot be undone.</p>
    </div>

    <footer class="margin-top-md">
      <div class="flex justify-end gap-xs flex-wrap">
        <button class="btn btn--subtle js-dialog__close">Cancel</button>
        <button class="btn btn--accent">Delete</button>
      </div>
    </footer>
  </div>
</div>
<!-- Confirmation Dialog END -->