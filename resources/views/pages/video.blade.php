@extends('apps.master')
@section('content')

<div class="container max-width-lg padding-y-xl grid gap-md">
  <!-- Sticky Share Sidebar -->
  <div class="col-1@md display@md">
  <ul class="sticky-sharebar__list position-fixed position-sticky top-xs@xs">
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="twitter" data-text="Hi there! https://codyhouse.co via @CodyWebHouse" data-hashtags="#nuggets, #dev" href="https://twitter.com/intent/tweet">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Twitter</title><g><path d="M32,6.1c-1.2,0.5-2.4,0.9-3.8,1c1.4-0.8,2.4-2.1,2.9-3.6c-1.3,0.8-2.7,1.3-4.2,1.6C25.7,3.8,24,3,22.2,3 c-3.6,0-6.6,2.9-6.6,6.6c0,0.5,0.1,1,0.2,1.5C10.3,10.8,5.5,8.2,2.2,4.2c-0.6,1-0.9,2.1-0.9,3.3c0,2.3,1.2,4.3,2.9,5.5 c-1.1,0-2.1-0.3-3-0.8c0,0,0,0.1,0,0.1c0,3.2,2.3,5.8,5.3,6.4c-0.6,0.1-1.1,0.2-1.7,0.2c-0.4,0-0.8,0-1.2-0.1 c0.8,2.6,3.3,4.5,6.1,4.6c-2.2,1.8-5.1,2.8-8.2,2.8c-0.5,0-1.1,0-1.6-0.1C2.9,27.9,6.4,29,10.1,29c12.1,0,18.7-10,18.7-18.7 c0-0.3,0-0.6,0-0.8C30,8.5,31.1,7.4,32,6.1z"></path></g></svg>
      </a>
    </li>
  
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="facebook" data-url="https://codyhouse.co" href="http://www.facebook.com/sharer.php">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Facebook</title><path d="M32,16A16,16,0,1,0,13.5,31.806V20.625H9.438V16H13.5V12.475c0-4.01,2.389-6.225,6.043-6.225a24.644,24.644,0,0,1,3.582.312V10.5H21.107A2.312,2.312,0,0,0,18.5,13v3h4.438l-.71,4.625H18.5V31.806A16,16,0,0,0,32,16Z"></path></svg>
      </a>
    </li>
  
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="pinterest" data-description="Description for my Pinterest share" data-media="https://codyhouse.co/app/assets/img/social-sharing-img-1.jpg" href="http://pinterest.com/pin/create/button">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Pinterest</title><g><path d="M16,0C7.2,0,0,7.2,0,16c0,6.8,4.2,12.6,10.2,14.9c-0.1-1.3-0.3-3.2,0.1-4.6c0.3-1.2,1.9-8,1.9-8 s-0.5-1-0.5-2.4c0-2.2,1.3-3.9,2.9-3.9c1.4,0,2,1,2,2.3c0,1.4-0.9,3.4-1.3,5.3c-0.4,1.6,0.8,2.9,2.4,2.9c2.8,0,5-3,5-7.3 c0-3.8-2.8-6.5-6.7-6.5c-4.6,0-7.2,3.4-7.2,6.9c0,1.4,0.5,2.8,1.2,3.7c0.1,0.2,0.1,0.3,0.1,0.5c-0.1,0.5-0.4,1.6-0.4,1.8 C9.5,21.9,9.3,22,9,21.8c-2-0.9-3.2-3.9-3.2-6.2c0-5,3.7-9.7,10.6-9.7c5.6,0,9.9,4,9.9,9.2c0,5.5-3.5,10-8.3,10 c-1.6,0-3.1-0.8-3.7-1.8c0,0-0.8,3.1-1,3.8c-0.4,1.4-1.3,3.1-2,4.2c1.5,0.5,3.1,0.7,4.7,0.7c8.8,0,16-7.2,16-16C32,7.2,24.8,0,16,0z "></path></g></svg>
      </a>
    </li>
  
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="linkedin" data-url="http://codyhouse.co" href="https://www.linkedin.com/shareArticle">
        <svg class="icon" viewBox="0 0 32 32"><title>Share on Linkedin</title><g><path d="M29,1H3A2,2,0,0,0,1,3V29a2,2,0,0,0,2,2H29a2,2,0,0,0,2-2V3A2,2,0,0,0,29,1ZM9.887,26.594H5.374V12.25H9.887ZM7.63,10.281a2.625,2.625,0,1,1,2.633-2.625A2.624,2.624,0,0,1,7.63,10.281ZM26.621,26.594H22.2V19.656c0-1.687,0-3.75-2.35-3.75s-2.633,1.782-2.633,3.656v7.126H12.8V12.25h4.136v1.969h.094a4.7,4.7,0,0,1,4.231-2.344c4.513,0,5.359,3,5.359,6.844Z"></path></g></svg>
      </a>
    </li>
  
    <li>
      <a class="sticky-sharebar__btn js-social-share" data-social="mail" data-subject="Email Subject" data-body="Content of my email." href="mailto:">
        <svg class="icon" viewBox="0 0 32 32"><title>Share by Email</title><g><path d="M28,3H4A3.957,3.957,0,0,0,0,7V25a3.957,3.957,0,0,0,4,4H28a3.957,3.957,0,0,0,4-4V7A3.957,3.957,0,0,0,28,3Zm.6,6.8-12,9a1,1,0,0,1-1.2,0l-12-9A1,1,0,0,1,4.6,8.2L16,16.75,27.4,8.2a1,1,0,1,1,1.2,1.6Z"></path></g></svg>
      </a>
    </li>
  </ul>
</div>
<!-- Sticky Share Sidebar END -->

<!-- Content Start -->
<div class="col-11@md">
  <div class="card">
    <figure class="card__img">
      <img class="" src="/assets/img/article-v4-img-1.jpg" alt="Card preview img">
    </figure>
  <div class="padding-md">
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui ullam accusamus voluptate! Accusantium aperiam totam voluptatum at fugiat doloribus odit dolore fuga. Eum aliquam qui beatae recusandae, laborum explicabo nihil neque esse sequi cumque hic necessitatibus? Quam quaerat esse voluptatum.</p>
  </div>
<div class="border-top"></div>
<!-- Content END -->

<!-- Content Control -->
<div class="justify-between flex padding-xs padding-x-md">
  <!-- Like Box -->
  <menu class="menu-bar js-menu-bar">
    <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus padding-right-md margin-left-xs" data-label="Like this comment along with 5 other people" aria-pressed="false">
      <span class="comments__vote-icon-wrapper">
        <svg class="icon rate-cont__icon" viewBox="0 0 16 16" aria-hidden="true"><g stroke-width="1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="0.5" y="7.5" width="3" height="8"></rect><path d="M5.5,15.5h6.9a2,2,0,0,0,1.952-1.566l1.111-5A2,2,0,0,0,13.507,6.5H9.5v-4a2,2,0,0,0-2-2l-2,6"></path></g></svg>
      </span>
      <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">0</span>
    </button>
    
    <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
      <span class="comments__vote-icon-wrapper">
          <svg class="icon rate-cont__icon" viewBox="0 0 16 16" aria-hidden="true"><g stroke-width="1" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="0.5" y="0.5" width="3" height="8"></rect><path d="M5.5.5h6.9a2,2,0,0,1,1.952,1.566l1.111,5A2,2,0,0,1,13.507,9.5H9.5v4a2,2,0,0,1-2,2l-2-6"></path></g></svg>
      </span>
      <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">0</span>
    </button>
  </menu>
<!-- END -->


<!-- Control -->
  <menu class="menu-bar menu-bar--expanded@md js-menu-bar">
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
      
        <li class="menu-bar__item menu-bar__item--hide" role="menuitem">
          <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
            <path d="M15.707,0.293c-0.273-0.272-0.68-0.365-1.043-0.234l-14,5C0.287,5.193,0.026,5.54,0.002,5.939 c-0.024,0.4,0.192,0.775,0.551,0.955l4.586,2.292L11,5l-4.187,5.862l2.292,4.586C9.276,15.787,9.623,16,10,16 c0.021,0,0.041-0.001,0.061-0.002c0.4-0.024,0.747-0.284,0.882-0.662l5-14C16.072,0.973,15.98,0.566,15.707,0.293z"></path>
          </svg>
          <span class="menu-bar__label">Send</span>
        </li>
      
        <li class="menu-bar__item menu-bar__item--hide" role="menuitem">
          <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
            <path d="M8,12c0.3,0,0.5-0.1,0.7-0.3L14.4,6L13,4.6l-4,4V0H7v8.6l-4-4L1.6,6l5.7,5.7C7.5,11.9,7.7,12,8,12z"></path>
            <rect x="1" y="14" width="14" height="2"></rect>
          </svg>
          <span class="menu-bar__label">Download</span>
        </li>
      
      </menu>
      </div>
      <!-- END Content Control -->

      <div class="border-top padding-x-sm padding-top-sm">

      <!-- Userbox -->
      <div class="justify-between flex padding-sm">

        <!-- User Infos -->
        <div class="author author--minimal">
          <a href="#0" class="author__img-wrapper">
            <img src="/assets/img/author-img-1.jpg" alt="Author picture">
          </a>
          <div class="author__content">
            <h4 class="text-base">by <a href="#0" rel="author">Olivia Gribben</a></h4>
          </div>
      </div><!-- user infos -->
   
      
           
      <!-- Follow -->
           <fieldset>
            <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
              <li>
                <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag" for="checkbox-tag-phone-call">
                  <input class="sr-only" type="checkbox" id="checkbox-tag-phone-call" checked>
                  <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                  <span>Followed</span>
                </label>
              </li>
            </ul>
          </fieldset>
        </div>
      <!-- END -->

      <!-- Discription -->
      <div class="padding-xs">
      <p class="color-contrast-medium text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia minus culpa commodi!</p>
      </div>
      <!-- END -->

      <!-- Tags -->
      <div class="padding-left-sm">

      <h1 class="text-md padding-top-sm padding-bottom-xs">Tags</h1>
      <div class="">
        <ul class="flex flex-wrap gap-xxs">
      
          <div class="margin-bottom-md">
            <button class="chip chip--interactive text-sm">
              <i class="chip__label">Tag1</i>
            </button>
          </div>
      
          <div class="margin-bottom-md">
            <button class="chip chip--interactive text-sm">
              <i class="chip__label">Tag2</i>
            </button>
          </div>

          <div class="margin-bottom-md">
            <button class="chip chip--interactive text-sm">
              <i class="chip__label">Tag3</i>
            </button>
          </div>
      
        </ul>
      </div>
    </div>
  </div>
  <!-- END Tags-->
      <!-- END Content Box -->

      <div class="border-top"></div>

      <!-- Comments -->
      <section class="comments padding-md">
        <div class="margin-bottom-lg">
          <div class="flex gap-sm flex-column flex-row@md justify-between items-center@md">
            <div>
              <h1 class="text-md">Comments</h1>
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
                <img src="/assets/img/chips-img-1.jpg" alt="Author picture">
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
                <img src="/assets/img/chips-img-2.jpg" alt="Author picture">
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
                        <img src="/assets/img/chips-img-3.jpg" alt="Author picture">
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
          
                  <li class="comments__comment">
                    <div class="flex items-start">
                      <a href="#0" class="comments__author-img">
                        <img src="/assets/img/chips-img-3.jpg" alt="Author picture">
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
              </div>
            </details>
          </li>
      
          <li class="comments__comment">
            <div class="flex items-start">
              <a href="#0" class="comments__author-img">
                <img src="/assets/img/chips-img-3.jpg" alt="Author picture">
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
      
        <form>
          <fieldset>
            <legend class="form-legend">Add a new comment</legend>
      
            <div class="margin-bottom-xs">
              <label class="sr-only" for="commentNewContent">Your comment</label>
              <textarea class="form-control width-100%" name="commentNewContent" id="commentNewContent"></textarea>
            </div>
      
            <div>
              <button class="btn btn--primary">Post comment</button>
            </div>
          </fieldset>
        </form>
      </section>
      <!-- END -->       
          </div>
        </div>

    <!-- END -->

    <!-- Sidebar -->
      <div class="col-3@md">
        <a class="card-v14 padding-sm flex flex-column position-fixed position-sticky top-sm@xs" href="#">
          <h3 class="text-md">Profile Card</h3>
          <p class="color-contrast-medium text-sm padding-y-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia minus culpa commodi!</p>
          <div class="avatar-group">
            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-1.svg" alt="Emily Ewing" title="Emily Ewing">
              </figure>
            </div>
          
            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="James Powell">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-2.svg" alt="James Powell" title="James Powell">
              </figure>
            </div>
          
            <div class="avatar">
              <figure class="avatar__figure" role="img" aria-label="Olivia Gribben">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="/assets/img/avatar-img-3.svg" alt="Olivia Gribben" title="Olivia Gribben">
              </figure>
            </div>
          
            <button class="avatar avatar--btn" aria-label="show all users">
              <figure aria-hidden="true" class="avatar__figure">
                <div class="avatar__users-counter"><span>+12</span></div>
              </figure>
            </button>
          </div> 
          <!-- avatar-group -->
          <p class="text-right color-primary margin-top-auto">Explore →</p>
        </a>
      </div>
      <!-- END -->
 </div>
 @endsection
