<!-- Content Table Column -->
<div class="col-12@md">
    <div class="card">
        <div class="int-table-actions padding-bottom-xxxs" data-table-controls="table-1">

            <!-- Control Bar -->
              <div class="controlbar--sticky flex justify-between">
                <div class="margin-xxs">
                  <div class="inline-flex items-baseline">
                    <h1 class="text-md color-contrast-high margin-x-xs" for="filterItems">Posts</h1>
                  </div>
                </div>
                <!-- END Control Bar-->

                <!-- Menu Bar -->
                <div class="flex flex-wrap items-center justify-between margin-right-xxs">
                  <div class="flex flex-wrap">

                    <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar margin-right-xs" id="btnDeleteMultiple">
                      <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                        <svg class="icon menu-bar__icon" width="20" height="20" viewBox="0 0 20 20">
                          <circle cx="8" cy="7.5" r="1.5" />
                          <circle cx="1.5" cy="7.5" r="1.5" />
                          <circle cx="14.5" cy="7.5" r="1.5" /></svg>
                      </li>
                      <li class="menu-bar__item" role="menuitem">
                      <svg class="icon menu-bar__icon" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M2.49 6.64v10.79a2.49 2.49 0 0 0 2.49 2.49h9.96a2.49 2.49 0 0 0 2.49-2.49v-10.79z m4.98 9.13h-1.66v-5.81h1.66z m3.32 0h-1.66v-5.81h1.66z m3.32 0h-1.66v-5.81h1.66z"></path>
                        <path d="M19.09 3.32h-4.98v-2.49a0.83 0.83 0 0 0-0.83-0.83h-6.64a0.83 0.83 0 0 0-0.83 0.83v2.49h-4.98a0.83 0.83 0 0 0 0 1.66h18.26a0.83 0.83 0 0 0 0-1.66z m-11.62-1.66h4.98v1.66h-4.98z"></path>
                      </svg>
                        <span class="menu-bar__label">Delete</span>
                        <span class="counter counter--critical counter--docked"><span id="deleteBadge">1</span> <i class="sr-only">Notifications</i></span>
                      </li>
                    </menu>
                      
                    <div class="menu-bar__item js-menu-bar" aria-controls="create-modal">
                    <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                      <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
                    </svg>
                      <span class="menu-bar__label">Add Post</span>
                    </div>
              
                    <div class="menu-bar__item" aria-controls="modal-search">
                      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                      <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
                      </svg>
                      <span class="menu-bar__label">Search Posts</span>
                    </div>
              
                    <div class="menu-bar__item">
                      <a href="{{ url('admin/posts/settings') }}">
                        <svg class="icon menu-bar__icon" viewBox="0 0 20 20">
                        <path d="M18.92 8.48a2.5 2.5 0 0 1-1.54-3.71c0.4-0.67 0.28-1.25-0.12-1.65l-0.38-0.38c-0.4-0.4-0.98-0.52-1.65-0.12a2.5 2.5 0 0 1-3.71-1.54c-0.19-0.76-0.68-1.08-1.25-1.08h-0.54c-0.56 0-1.06 0.32-1.25 1.08a2.5 2.5 0 0 1-3.71 1.54c-0.67-0.4-1.25-0.28-1.65 0.12l-0.39 0.38c-0.4 0.4-0.52 0.98-0.11 1.65a2.5 2.5 0 0 1-1.54 3.71c-0.76 0.19-1.08 0.68-1.08 1.25v0.54c0 0.56 0.32 1.06 1.08 1.25a2.5 2.5 0 0 1 1.54 3.71c-0.4 0.67-0.28 1.25 0.12 1.65l0.38 0.38c0.4 0.4 0.98 0.52 1.65 0.12a2.5 2.5 0 0 1 3.71 1.54c0.19 0.76 0.68 1.08 1.25 1.08h0.54c0.56 0 1.06-0.32 1.25-1.08a2.5 2.5 0 0 1 3.71-1.54c0.67 0.4 1.25 0.28 1.65-0.12l0.38-0.38c0.4-0.4 0.52-0.98 0.12-1.65a2.5 2.5 0 0 1 1.54-3.71c0.76-0.19 1.08-0.68 1.08-1.25v-0.54c0-0.56-0.33-1.06-1.08-1.25z m-8.92 5.27a3.75 3.75 0 1 1 0-7.5 3.75 3.75 0 0 1 0 7.5z"></path>
                      </svg>
                      </a>
                      <span class="menu-bar__label">Settings</span>
                    </div>
              
                    <div class="int-table-actions" data-table-controls="table-1">
                      <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar" id="btnRefreshTable">
                        <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                          <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                            <circle cx="8" cy="7.5" r="1.5" />
                            <circle cx="1.5" cy="7.5" r="1.5" />
                            <circle cx="14.5" cy="7.5" r="1.5" />
                          </svg>
                        </li>
                      </menu>
              
                        <menu class="menu-bar is-hidden js-menu-bar" id="btnPostMultiple">
                            <li class="menu-bar__item" role="menuitem">
                                <svg class="icon menu-bar__icon" width="20" height="20" viewBox="0 0 20 20">
                                  <g stroke-width="2">
                                  <path fill="none" stroke-miterlimit="10" stroke-linejoin="miter" stroke-linecap="butt" d="M18.26 1.66l-12.45 9.96v5.81l2.99-3.57"></path>
                                  <path fill="none" stroke-linecap="square" stroke-miterlimit="10" stroke-linejoin="miter" d="M1.66 8.3l16.6-6.64-3.32 16.6z"></path>
                                  </g>
                                </svg>
                                <span class="menu-bar__label">Post</span>
                                <span class="counter counter--critical counter--docked"><span id="postBadge">1</span> <i class="sr-only">Notifications</i></span>
                            </li>
                        </menu>

                    </div> <!-- end of <div class="int-table-actions" data-table-controls="table-1"> -->
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
                          <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example">
                            <svg class="icon" viewBox="0 0 16 16">
                              <circle cx="8" cy="7.5" r="1.5" />
                              <circle cx="1.5" cy="7.5" r="1.5" />
                              <circle cx="14.5" cy="7.5" r="1.5" /></svg>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              
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
                    <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                      <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
                      <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
                    </svg>
                    <span>Delete</span>
                  </span>
                </li>
              </menu>
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