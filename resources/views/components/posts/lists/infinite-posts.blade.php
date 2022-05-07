<div class="flex justify-between">
        <div class="inline-flex items-baseline articles-v3__author padding-sm">
          <a href="#0" class="articles-v3__author-img">
            <img class="object-cover" src="/assets/img/avatar.png" alt="Author picture">
          </a>

          <div class="text-component text-sm line-height-xs text-space-y-xxs">
            <p><a href="#0" class="articles-v3__author-name" rel="author">sam mitcher</a></p>
            <p class="color-contrast-medium">3 days go</p>
          </div>
        </div>

         <!-- Edit -->
         <div class="flex flex-wrap items-center justify-between">
           <div class="flex flex-wrap">
            <menu class="menu-bar js-menu-bar">
              <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                  <circle cx="8" cy="7.5" r="1.5" />
                  <circle cx="1.5" cy="7.5" r="1.5" />
                  <circle cx="14.5" cy="7.5" r="1.5" /></svg>
              </li>

              <li class="menu-bar__item menu-bar__item--hide" role="menuitem">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 12 12">
                  <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                </svg>
                <span class="menu-bar__label">Edit</span>
              </li>

              <li class="menu-bar__item menu-bar__item--hide" role="menuitem">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                  <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                  <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                </svg>
                <span class="menu-bar__label">Delete</span>
              </li>
            </menu>

           </div>
         </div>
       </div>

    <!-- Status Body -->
    <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
      <p class="padding-sm text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis! Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
        <img class="block width-100% height-100% object-cover" src="/assets/img/random-backgrounds/3.jpg" alt="Post Picture">

        <!-- Comments -->
        <section class="comments padding-x-md">
          <div class="margin-bottom-lg padding-top-md">
            <div class="flex gap-sm flex-column flex-row@md justify-between items-center@md">
              <div>
                <h1 class="text-component text-sm color-contrast-medium">Comments (23)</h1>
              </div>

              <form aria-label="Choose sorting option">
                <div class="flex flex-wrap gap-sm text-sm">
                  <div class="position-relative">
                    <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsPopular" checked>
                    <label for="sortCommentsPopular">Popular</label>
                  </div>

                  <div class="position-relative">
                    <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsNewest">
                    <label for="sortCommentsNewest">Newest</label>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <ul class="margin-bottom-lg">
            <li class="comments__comment">
              <div class="flex items-start">
                <a href="#0" class="comments__author-img">
                  <img class="object-cover" src="/assets/img/avatar.png" alt="Author picture">
                </a>

                <div class="comments__content margin-top-xxxs">
                  <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                    <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>

                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit sit sed cupiditate vel, sapiente aspernatur, reiciendis repellat ad delectus quia ea ipsam minima in dignissimos commodi velit nemo voluptatibus quisquam.</p>
                  </div>

                  <div class="margin-top-xs text-sm">
                    <div class="flex gap-xxs items-center">
                      <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                        <span class="comments__vote-icon-wrapper">
                          <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                        </span>

                        <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                      </button>

                      <span class="comments__inline-divider" aria-hidden="true"></span>

                      <button class="reset comments__label-btn js-tab-focus">Reply</button>

                      <span class="comments__inline-divider" aria-hidden="true"></span>

                      <time class="comments__time" aria-label="1 hour ago">1h</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="comments__comment">
              <div class="flex items-start">
                <a href="#0" class="comments__author-img">
                  <img class="object-cover" src="/assets/img/avatar.png" alt="Author picture">
                </a>

                <div class="comments__content margin-top-xxxs">
                  <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                    <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
                  </div>

                  <div class="margin-top-xs text-sm">
                    <div class="flex gap-xxs items-center">
                      <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                        <span class="comments__vote-icon-wrapper">
                          <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                        </span>

                        <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                      </button>

                      <span class="comments__inline-divider" aria-hidden="true"></span>

                      <button class="reset comments__label-btn js-tab-focus">Reply</button>

                      <span class="comments__inline-divider" aria-hidden="true"></span>

                      <time class="comments__time" aria-label="1 hour ago">1h</time>
                    </div>
                  </div>
                </div>
              </div>

              <details class="comments__details details js-details">
                <summary class="details__summary color-primary js-details__summary text-sm" role="button">
                  <span class="flex items-center">
                    <svg class="icon icon--xxs margin-right-xxs" aria-hidden="true" viewBox="0 0 12 12"><path d="M2.783.088A.5.5,0,0,0,2,.5v11a.5.5,0,0,0,.268.442A.49.49,0,0,0,2.5,12a.5.5,0,0,0,.283-.088l8-5.5a.5.5,0,0,0,0-.824Z"></path></svg>
                    <span>View 2 replies</span>
                  </span>
                </summary>

                <div class="details__content js-details__content">
                  <ul>
                    <li class="comments__comment">
                      <div class="flex items-start">
                        <a href="#0" class="comments__author-img">
                          <img class="object-cover" src="/assets/img/avatar.png" alt="Author picture">
                        </a>

                        <div class="comments__content margin-top-xxxs">
                          <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                            <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
                          </div>

                          <div class="margin-top-xs text-sm">
                            <div class="flex gap-xxs items-center">
                              <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                                <span class="comments__vote-icon-wrapper">
                                  <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                                </span>

                                <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                              </button>

                              <span class="comments__inline-divider" aria-hidden="true"></span>

                              <button class="reset comments__label-btn js-tab-focus">Reply</button>

                              <span class="comments__inline-divider" aria-hidden="true"></span>

                              <time class="comments__time" aria-label="1 hour ago">1h</time>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                </ul>
        </section>

      <!-- Interaction -->
      <footer class="card-v10__footer">
           <ul class="card-v10__social-list">
               <li class="card-v10__social-item">
                   <button class="reset card-v10__social-btn js-tab-focus" aria-label="Like this content along with 120 other people">
                       <svg class="icon" viewBox="0 0 12 12">
                           <g>
                               <path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path>
                           </g>
                       </svg>

                       <span>120 Likes</span>
                   </button>
               </li>

               <li class="card-v10__social-item">
                   <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                       <svg class="icon" viewBox="0 0 12 12">
                           <g>
                               <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                           </g>
                       </svg>
                       <span>23 Comments</span>
                   </button>
               </li>

           </ul>
       </footer>