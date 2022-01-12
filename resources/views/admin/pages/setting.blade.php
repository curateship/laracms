@extends('apps.master')
@section('content')
<div class="container max-width-lg padding-y-xl grid gap-md">
    <!-- Main Content Column-->
    <div class="col-12@md">
          <div class="background-bg shadow-md border radius-md padding-sm">

            <section class="position-relative z-index-1">
              <div class="container max-width-adaptive-md">
                <div class="margin-bottom-sm">
                </div>
            
                <div class="grid gap-sm">
                  <div class="col-3@md">
                    <div class="toc toc--static@md position-sticky@md js-toc">
                      <button class="reset toc__control padding-sm no-js:is-hidden js-tab-focus js-toc__control" aria-controls="toc">
                        <span class="toc__control-text">
                          <i class="js-toc__control-label">Categories <span class="sr-only">- press button to select a category.</span></i>
                          <i aria-hidden="true">Select</i>
                        </span>
            
                        <svg class="toc__icon-arrow icon icon--xs margin-left-xxxs no-js:is-hidden" viewBox="0 0 16 16" aria-hidden="true">
                          <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M3 3l10 10"></path>
                            <path d="M13 3L3 13"></path>
                          </g>
                        </svg>
                      </button>
            
                      <nav class="toc__nav">
                        <ul class="toc__list js-toc__list">
                          <li class="toc__label" tabindex="0">Categories</li>
                          <li><a class="toc__link js-smooth-scroll" href="#basics">Basics</a></li>
                          <li><a class="toc__link js-smooth-scroll" href="#account">Account</a></li>
                          <li><a class="toc__link js-smooth-scroll" href="#payments">Payments</a></li>
                          <li><a class="toc__link js-smooth-scroll" href="#privacy">Privacy</a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
            
                  <div class="toc-content js-toc-content col-9@md">
                    <div class="grid gap-lg">
                      <div>
                        <h2 id="basics" class="text-md margin-bottom-xs">Basics</h2>
            
                        <ul class="accordion-v2 flex flex-column gap-xxxs js-accordion" data-animation="on" data-multi-items="on" data-version="v2">
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I change my password?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I sign up?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Do you offer a student discount?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I request a refund?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                        </ul>
                      </div>
            
                      <div>
                        <h2 id="account" class="text-md margin-bottom-xs">Account</h2>
            
                        <ul class="accordion-v2 flex flex-column gap-xxxs js-accordion" data-animation="on" data-multi-items="on" data-version="v2">
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I change my password?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I delete my account?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">I forgot my password. How do I reset it?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How do I change my account settings?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                        </ul>
                      </div>
            
                      <div>
                        <h2 id="payments" class="text-md margin-bottom-xs">Payments</h2>
            
                        <ul class="accordion-v2 flex flex-column gap-xxxs js-accordion" data-animation="on" data-multi-items="on" data-version="v2">
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Where can I download an invoice?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Why did my payment fail?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Can I pay using Paypal?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                        </ul>
                      </div>
            
                      <div>
                        <h2 id="privacy" class="text-md margin-bottom-xs">Privacy</h2>
            
                        <ul class="accordion-v2 flex flex-column gap-xxxs js-accordion" data-animation="on" data-multi-items="on" data-version="v2">
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Can I specify my own private key?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">My files are missing. How do I get them back?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">How can I delete my account data?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                          <li class="accordion-v2__item  js-accordion__item">
                            <button class="reset accordion-v2__header padding-y-sm padding-x-md js-tab-focus" type="button">
                              <span class="text-md">Do you store any private information?</span>
            
                              <svg class="icon accordion-v2__icon-arrow no-js:is-hidden" viewBox="0 0 20 20">
                                <g class="icon__group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                  <line x1="3" y1="3" x2="17" y2="17" />
                                  <line x1="17" y1="3" x2="3" y2="17" />
                                </g>
                              </svg>
                            </button>
            
                            <div class="accordion-v2__panel padding-top-xxxs padding-x-md padding-bottom-md js-accordion__panel">
                              <div class="text-component line-height-lg">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum a ab quae quas optio ut officia quia? Modi at impedit dolorem est voluptatem facilis, beatae atque tenetur, soluta dolorum inventore sapiente laborum. Alias esse soluta porro distinctio aperiam, qui suscipit.</p>
                              </div>
                            </div>
                          </li>
            
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

      </div>
    </div>
 <!-- END content table-->

 <!-- Sidebar -->
 <div class="col-3@md">
    <div class="background-bg shadow-md border radius-md position-fixed position-sticky top-0@xs">
      <nav class="sidenav padding-y-sm js-sidenav">
         <div class="sidenav__label margin-bottom-xxxs">
             </div>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M6,0H1C0.4,0,0,0.4,0,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C7,0.4,6.6,0,6,0z M5,5H2V2h3V5z"></path><path d="M15,0h-5C9.4,0,9,0.4,9,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C16,0.4,15.6,0,15,0z M14,5h-3V2h3V5z"></path><path d="M6,9H1c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C7,9.4,6.6,9,6,9z M5,14H2v-3h3V14z"></path><path d="M15,9h-5c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C16,9.4,15.6,9,15,9z M14,14h-3v-3h3V14z"></path></g></svg>
                        <span class="sidenav__text text-sm@md">Dashboard</span>
                        <span class="sidenav__counter">12 <i class="sr-only">notifications</i></span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">New widget</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Analytics</span>
                    </a>
                  </li>
                </ul>
                </li>
        
              <li class="sidenav__item sidenav__item--expanded">
                <a href="#0" class="sidenav__link" aria-current="page">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M14,7H2v7c0,0.6,0.4,1,1,1h10c0.6,0,1-0.4,1-1V7z"></path><rect y="1" width="16" height="4"></rect></g></svg>
                  <span class="sidenav__text text-sm@md">Products</span>
                </a>
        
                <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                  <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                </button>
        
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add new</span>
                    </a>
                  </li>
        
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Categories</span>
                    </a>
                  </li>
                </ul>
              </li>
        
              <li class="sidenav__item">
                <a href="#0" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M14,6.883V13H2V6.82L0,5.695V14c0,0.553,0.448,1,1,1h14c0.552,0,1-0.447,1-1V5.783L14,6.883z"></path><path d="M15,1H1C0.4,1,0,1.4,0,2v1.4l8,4.5l8-4.4V2C16,1.4,15.6,1,15,1z"></path></g></svg>
                  <span class="sidenav__text text-sm@md">Messages</span>
        
                  <span class="sidenav__counter">18 <i class="sr-only">notifications</i></span>
                </a>
              </li>
            </ul>
        
            <div class="sidenav__divider margin-y-xs" role="presentation"></div>
        
            <div class="sidenav__label margin-bottom-xxxs">
              <span class="text-sm color-contrast-medium text-xs@md">Other</span>
            </div>
        
            <ul class="sidenav__list">
              <li class="sidenav__item">
                <a href="#0" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><circle cx="6" cy="8" r="2"></circle><path d="M10,2H6C2.7,2,0,4.7,0,8s2.7,6,6,6h4c3.3,0,6-2.7,6-6S13.3,2,10,2z M10,12H6c-2.2,0-4-1.8-4-4s1.8-4,4-4h4 c2.2,0,4,1.8,4,4S12.2,12,10,12z"></path></g></svg>
                  <span class="sidenav__text text-sm@md">Settings</span>
                </a>
              </li>
        
              <li class="sidenav__item">
                <a href="#0" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M12.25,8.231C11.163,9.323,9.659,10,8,10S4.837,9.323,3.75,8.231C1.5,9.646,0,12.145,0,15v1h16 v-1C16,12.145,14.5,9.646,12.25,8.231z"></path><circle cx="8" cy="4" r="4"></circle></g></svg>
                  <span class="sidenav__text text-sm@md">Account</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>

    </div>
  </div>
</section>
<!-- END -->

</div>
@endsection