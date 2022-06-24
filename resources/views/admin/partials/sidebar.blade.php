@push('custom-scripts')
    @include('admin.dashboard.scripts')
@endpush

<!-- 👇 Sidebar Wrapper-->
<div class="card display@md position-fixed position-sticky top-sm@xs">
    <div class="background-bg radius-md padding-bottom-sm">
      <nav class="sidenav js-sidenav">
         <div class="sidenav__label margin-bottom-xs">
            </div>
              <ul class="sidenav__list">

                <!-- Home -->
                <li class="sidenav__item">
                <a href="/home" class="sidenav__link" {{ str_replace(url('/'), '', url()->full()) === '/home' ? 'aria-current=page' : '' }}>
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M6,0H1C0.4,0,0,0.4,0,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C7,0.4,6.6,0,6,0z M5,5H2V2h3V5z"></path><path d="M15,0h-5C9.4,0,9,0.4,9,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C16,0.4,15.6,0,15,0z M14,5h-3V2h3V5z"></path><path d="M6,9H1c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C7,9.4,6.6,9,6,9z M5,14H2v-3h3V14z"></path><path d="M15,9h-5c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C16,9.4,15.6,9,15,9z M14,14h-3v-3h3V14z"></path></g></svg>
                      <span class="sidenav__text text-sm@md">Dashboard</span>
                  </a>
                    <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                      <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                    </button>
                </li>

                <!-- My Posts -->
                <li class="sidenav__item">
                <a href="/posts" class="sidenav__link" {{ strpos(url()->full(), '/posts') !== false ? 'aria-current=page' : '' }}>
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M14,7H2v7c0,0.6,0.4,1,1,1h10c0.6,0,1-0.4,1-1V7z"></path><rect y="1" width="16" height="4"></rect></g></svg>
                  <span class="sidenav__text text-sm@md">Posts</span>
                    <span class="sidenav__counter dashboard-counter" data-target="total">0</span>
                </a>

                <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                  <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                </button>

                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="/posts/create" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add new</span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="/posts?status=published" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Published</span>
                        <span class="sidenav__counter dashboard-counter" data-target="published">0</span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="/posts?status=draft" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Draft</span>
                        <span class="sidenav__counter dashboard-counter" data-target="drafts">0</span>
                    </a>
                  </li>

                </ul>
              </li>
            </ul>

            <ul class="sidenav__list">
              <!-- My Comments -->
              <li class="sidenav__item">
                  <a href="#" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                    <g ><path d="M14.75 4.25h-1.5v4.75a1.5 1.5 0 0 1-1.5 1.5h-4.47l-2 1.75h4.64l3.43 2.45a0.25 0.25 0 0 0 0.15 0.05 0.25 0.25 0 0 0 0.11-0.03 0.25 0.25 0 0 0 0.14-0.22v-2.25h1a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1z"></path>
                      <path d="M11.75 1h-10.5a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h1.5v3.25a0.25 0.25 0 0 0 0.15 0.23 0.25 0.25 0 0 0 0.1 0.02 0.25 0.25 0 0 0 0.16-0.06l3.93-3.44h4.66a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1z"></path>
                    </g>
                  </svg>
                    <span class="sidenav__text text-sm@md">My Comments</span>
                  </a>
              </li>

              <!-- Favorites -->
              <li class="sidenav__item">
              <a href="/admin/favorites/" class="sidenav__link" {{ strpos(url()->full(), '/admin/favorites') !== false ? 'aria-current=page' : '' }}>
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                    <g ><path d="M6.62 12.22a5.08 5.08 0 0 1 7.69-4.37l1.56-1.53a0.54 0.54 0 0 0-0.3-0.91l-4.89-0.71-2.18-4.43a0.56 0.56 0 0 0-0.97 0l-2.18 4.43-4.89 0.71a0.54 0.54 0 0 0-0.3 0.91l3.54 3.46-0.83 4.87a0.54 0.54 0 0 0 0.77 0.56l3.17-1.66a5.07 5.07 0 0 1-0.19-1.33z"></path><path d="M11.71 8.15a4.07 4.07 0 1 0 4.08 4.07 4.07 4.07 0 0 0-4.08-4.07z m2.04 5.6h-4.08v-1.02h4.08z m0-2.04h-4.08v-1.02h4.08z"></path>
                    </g>
                  </svg>
                      <span class="sidenav__text text-sm@md">Favorites</span>
                  </a>
              </li>

              <!-- Edit Profile -->
              <li class="sidenav__item">
                <a href="/user/edit" class="sidenav__link" {{ strpos(url()->full(), '/user/edit') !== false ? 'aria-current=page' : '' }}>
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><circle cx="6" cy="8" r="2"></circle><path d="M10,2H6C2.7,2,0,4.7,0,8s2.7,6,6,6h4c3.3,0,6-2.7,6-6S13.3,2,10,2z M10,12H6c-2.2,0-4-1.8-4-4s1.8-4,4-4h4 c2.2,0,4,1.8,4,4S12.2,12,10,12z"></path></g></svg>
                  <span class="sidenav__text text-sm@md">Settings</span>
                </a>
              </li>

            </ul>
          </nav>
    </div>
 </div>
