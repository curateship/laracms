<!-- Create Modal -->
<div id="create-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Add User</h1>

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

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Name">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Username">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Email">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="passwords" name="passwords" id="inputname" placeholder="Passwords">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="passwords" name="passwords" id="inputname" placeholder="Confirm Passwords">
              </div>

              <div>
                <textarea class="form-control width-100% height-250 margin-bottom-sm" name="textarea" id="textarea" placeholder="Enter Bio"></textarea>
              </div>

              <div class="file-upload inline-block js">
                <label for="upload2" class="file-upload__label btn btn--primary">
                  <span class="flex items-center">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>

                    <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload</span>
                  </span>
                </label>

                <input type="file" class="file-upload__input" name="upload2" id="upload2" multiple>
              </div>

            </fieldset>

          </form>
        </div>

    <footer class="padding-y-sm padding-x-md bg inner-glow-top shadow-md flex-shrink-0">
      <div class="flex justify-end gap-xs">
        <button class="btn btn--subtle js-modal__close">Cancel</button>
        <button class="btn btn--accent">Save</button>
        <button class="btn btn--primary">Publish</button>
      </div>
    </footer>
  </div>

</div>
<!-- Create Modal END -->

<!-- Edit Modal -->
<div id="edit-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Edit User</h1>

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

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Name">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Username">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Email">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="passwords" name="passwords" id="inputname" placeholder="Passwords">
              </div>

              <div class="margin-bottom-sm">
                <input class="form-control width-100%" type="passwords" name="passwords" id="inputname" placeholder="Confirm Passwords">
              </div>

              <div>
                <textarea class="form-control width-100% height-250 margin-bottom-sm" name="textarea" id="textarea" placeholder="Enter Bio"></textarea>
              </div>

              <div class="author ">
                <a href="#0" class="author__img-wrapper">
                  <img src="/assets/img/author-img-1.jpg" alt="Author picture">
                </a>
              </div>

                <div class="file-upload inline-block">
                    <label for="upload2" class="file-upload__label btn btn--primary">
                      <span class="flex items-center">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>

                        <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload</span>
                      </span>
                    </label>

                    <input type="file" class="file-upload__input" name="upload2" id="upload2" multiple>
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
<div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="post-search">
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

