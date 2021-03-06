<!-- 👇 Sidebar Wrapper-->
<div class="card display@md position-fixed position-sticky top-sm@xs">
    <div class="background-bg shadow-md border radius-md padding-bottom-sm">
      <nav class="sidenav js-sidenav">
         <div class="sidenav__label margin-bottom-xs">
             </div>
                <ul class="sidenav__list">

                  <li class="sidenav__item">
                    <a href="/admin" class="sidenav__link">
                      <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M6,0H1C0.4,0,0,0.4,0,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C7,0.4,6.6,0,6,0z M5,5H2V2h3V5z"></path><path d="M15,0h-5C9.4,0,9,0.4,9,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1V1C16,0.4,15.6,0,15,0z M14,5h-3V2h3V5z"></path><path d="M6,9H1c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C7,9.4,6.6,9,6,9z M5,14H2v-3h3V14z"></path><path d="M15,9h-5c-0.6,0-1,0.4-1,1v5c0,0.6,0.4,1,1,1h5c0.6,0,1-0.4,1-1v-5C16,9.4,15.6,9,15,9z M14,14h-3v-3h3V14z"></path></g></svg>
                        <span class="sidenav__text text-sm@md">Dashboard</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="admin/post/add" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add Post</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="admin/users/create" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add User</span>
                    </a>
                  </li>
                </ul>
                </li>

                <li class="sidenav__item">
                <a href="{{ route('admin.posts.index') }}" class="sidenav__link" {{ strpos(url()->full(), '/admin/posts') !== false ? 'aria-current=page' : '' }}>
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><path d="M14,7H2v7c0,0.6,0.4,1,1,1h10c0.6,0,1-0.4,1-1V7z"></path><rect y="1" width="16" height="4"></rect></g></svg>
                  <span class="sidenav__text text-sm@md">Posts</span>
                </a>

                <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                  <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                </button>

                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="/admin/posts/create" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add new</span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Draft</span>
                      <span class="sidenav__counter">4 <i class="sr-only">notifications</i></span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="/admin/post/trash" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Trash</span>
                      <span class="sidenav__counter">3 <i class="sr-only">notifications</i></span>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="sidenav__item">
                <a href="" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g>
                  <path d="M15,4H1A.945.945,0,0,0,0,5V15a.945.945,0,0,0,1,1H15a.945.945,0,0,0,1-1V5A.945.945,0,0,0,15,4ZM6,13V7l5,3Z"></path><path d="M3,0H13a1,1,0,0,1,1,1V2a0,0,0,0,1,0,0H2A0,0,0,0,1,2,2V1A1,1,0,0,1,3,0Z"></path>
                  </svg>
                  <span class="sidenav__text text-sm@md">Videos</span>
                </a>

                <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                  <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                </button>

                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="/admin/posts/create" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add new</span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Draft</span>
                      <span class="sidenav__counter">4 <i class="sr-only">notifications</i></span>
                    </a>
                  </li>

                  <li class="sidenav__item">
                    <a href="/admin/post/trash" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Trash</span>
                      <span class="sidenav__counter">3 <i class="sr-only">notifications</i></span>
                    </a>
                  </li>

                </ul>
              </li>

                <li class="sidenav__item">
                    <a href="{{ route('admin.users.index') }}" class="sidenav__link" {{ strpos(url()->full(), '/admin/users') !== false ? 'aria-current=page' : '' }}>
                    <svg class="icon sidenav__icon" aria-hidden="false" viewBox="0 0 16 16" aria-current="page"><g><path d="M12.25,8.231C11.163,9.323,9.659,10,8,10S4.837,9.323,3.75,8.231C1.5,9.646,0,12.145,0,15v1h16 v-1C16,12.145,14.5,9.646,12.25,8.231z"></path><circle cx="8" cy="4" r="4"></circle></g></svg>
                        <span class="sidenav__text text-sm@md">Users</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="/admin/users/create" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Admins</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Editors</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Registered</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Trash</span>
                    </a>
                  </li>
                </ul>
                </li>

                <li class="sidenav__item">
                <a href="{{ route('admin.comments.index') }}" class="sidenav__link" {{ strpos(url()->full(), '/admin/comments') !== false ? 'aria-current=page' : '' }}>
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g ><path d="M14.75 4.25h-1.5v4.75a1.5 1.5 0 0 1-1.5 1.5h-4.47l-2 1.75h4.64l3.43 2.45a0.25 0.25 0 0 0 0.15 0.05 0.25 0.25 0 0 0 0.11-0.03 0.25 0.25 0 0 0 0.14-0.22v-2.25h1a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1z"></path>
                        <path d="M11.75 1h-10.5a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h1.5v3.25a0.25 0.25 0 0 0 0.15 0.23 0.25 0.25 0 0 0 0.1 0.02 0.25 0.25 0 0 0 0.16-0.06l3.93-3.44h4.66a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1z"></path>
                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Comments</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                
                </ul>
                </li>

                <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g ><path d="M15.707,7.207,8.5,0H3V2H6.914l7.5,7.5a2.012,2.012,0,0,1,.187.227l1.106-1.106A1,1,0,0,0,15.707,7.207Z"></path> <path d="M13.707,10.207,6.5,3H1V8.5l7.207,7.207a1,1,0,0,0,1.414,0l4.086-4.086A1,1,0,0,0,13.707,10.207ZM4,7A1,1,0,1,1,5,6,1,1,0,0,1,4,7Z"></path>
                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Tags</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Admins</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Editors</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Registered</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Trash</span>
                    </a>
                  </li>
                </ul>
                </li>

                <li class="sidenav__item">
                  <a href="{{ route('admin.categories.index') }}" class="sidenav__link" {{ strpos(url()->full(), '/admin/categories') !== false ? 'aria-current=page' : '' }}>
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g >
                        <path d="M15,4H1A1,1,0,0,0,.02,5.2l2,10A1,1,0,0,0,3,16H13a1,1,0,0,0,.98-.8l2-10A1,1,0,0,0,15,4Z"></path><path d="M3,2H13a1,1,0,0,0,0-2H3A1,1,0,0,0,3,2Z"></path>
                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Categories</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Admins</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Editors</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Registered</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Trash</span>
                    </a>
                  </li>
                </ul>
                </li>

                <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g >
                      <path d="M2.64 2.31h10.56v-0.99a0.33 0.33 0 0 0-0.33-0.33h-9.9a0.33 0.33 0 0 0-0.33 0.33z"></path><path d="M14.52 2.97h-13.2a0.66 0.66 0 0 0-0.66 0.66v10.56a0.66 0.66 0 0 0 0.66 0.66h13.2a0.66 0.66 0 0 0 0.66-0.66v-10.56a0.66 0.66 0 0 0-0.66-0.66z m-9.24 2.31a0.99 0.99 0 1 1-0.99 0.99 0.99 0.99 0 0 1 0.99-0.99z m7.88 6.77a0.33 0.33 0 0 1-0.29 0.16h-9.57a0.33 0.33 0 0 1-0.26-0.53l1.98-2.64a0.33 0.33 0 0 1 0.24-0.13 0.32 0.32 0 0 1 0.25 0.1l1.71 1.71 2.75-3.66a0.33 0.33 0 0 1 0.55 0.03l2.64 4.63a0.33 0.33 0 0 1 0 0.33z"></path>
                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Galleries</span>
                        <span class="sidenav__counter">3 <i class="sr-only">notifications</i></span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                </ul>
                </li>

            </ul>

            <div class="sidenav__divider margin-y-xs" role="presentation"></div>

            <div class="sidenav__label margin-bottom-xxxs">
              <span class="text-sm color-contrast-medium text-xs@md">Administrations</span>
            </div>

            <ul class="sidenav__list">

            <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g >
                      <path d="M14,1H2A2,2,0,0,0,0,3v.4L8,7.9l8-4.4V3A2,2,0,0,0,14,1Z"></path><path d="M7.5,9.9,0,5.7V13a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V5.7L8.5,9.9A1.243,1.243,0,0,1,7.5,9.9Z"></path>                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Email</span>
                        <span class="sidenav__counter">3 <i class="sr-only">notifications</i></span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Add New</span>
                    </a>
                  </li>
                </ul>
                </li>

            <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                    <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <g >
                      <path d="M14,0H2C0.9,0,0,0.9,0,2v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V2C16,0.9,15.1,0,14,0z M4,2h2v4H4V2z M6,11.7V14H4v-2.3c-0.6-0.3-1-1-1-1.7c0-1.1,0.9-2,2-2s2,0.9,2,2C7,10.7,6.6,11.4,6,11.7z M12,14h-2v-4h2V14z M11,8 C9.9,8,9,7.1,9,6c0-0.7,0.4-1.4,1-1.7V2h2v2.3c0.6,0.3,1,1,1,1.7C13,7.1,12.1,8,11,8z"></path>
                      </g>
                    </svg>
                        <span class="sidenav__text text-sm@md">Tools</span>
                    </a>
                      <button class="reset sidenav__sublist-control js-sidenav__sublist-control js-tab-focus" aria-label="Toggle sub navigation">
                        <svg class="icon" viewBox="0 0 12 12"><polygon points="4 3 8 6 4 9 4 3"/></svg>
                      </button>
                <ul class="sidenav__list">
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Scrapers</span>
                    </a>
                  </li>
                  <li class="sidenav__item">
                    <a href="#0" class="sidenav__link">
                      <span class="sidenav__text text-sm@md">Tag Titles</span>
                    </a>
                  </li>
                </ul>
                </li>

              <li class="sidenav__item">
                <a href="http://localhost:3000/admin/setting" class="sidenav__link">
                  <svg class="icon sidenav__icon" aria-hidden="true" viewBox="0 0 16 16"><g><circle cx="6" cy="8" r="2"></circle><path d="M10,2H6C2.7,2,0,4.7,0,8s2.7,6,6,6h4c3.3,0,6-2.7,6-6S13.3,2,10,2z M10,12H6c-2.2,0-4-1.8-4-4s1.8-4,4-4h4 c2.2,0,4,1.8,4,4S12.2,12,10,12z"></path></g></svg>
                  <span class="sidenav__text text-sm@md">Settings</span>
                </a>
              </li>

            </ul>
          </nav>
    </div>
 </div>
