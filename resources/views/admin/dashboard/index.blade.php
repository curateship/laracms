@extends('admin.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">

    <!-- Col 3 -->
    <div class="col-4@md card">
      <p class="padding-sm">Latest Feeds</p>
      <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->

      <div class="articles-v3__author padding-x-sm padding-top-sm">
        <a href="#0" class="articles-v3__author-img">
          <img class="object-cover" src="http://localhost:3000/assets/img/avatar.png" alt="Author picture">
        </a>

        <div class="text-component text-xs line-height-xs text-space-y-xxs">
          <a href="/" class="color-contrast-high link-plain">
            <p rel="author">sam mitcher commented on "This is the post that is a bit long" 3 days go</p>
          </a>
        </div>
      </div>

      <div class="articles-v3__author padding-x-sm padding-y-xs">
        <a href="#0" class="articles-v3__author-img">
          <img class="object-cover" src="http://localhost:3000/assets/img/avatar.png" alt="Author picture">
        </a>

        <div class="text-component text-xs line-height-xs text-space-y-xxs">
          <a href="/" class="color-contrast-high link-plain">
            <p rel="author">Tim Sammie just joined 3 hours go</p>
          </a>
        </div>
      </div>
        
    </div>

    <!-- Col 8 -->
    <div class="col-8@md card">
      <div class="flex justify-between">
        <div class="inline-flex items-baseline articles-v3__author padding-y-xs padding-x-sm">
          <a href="#0" class="articles-v3__author-img">
            <img class="object-cover" src="http://localhost:3000/assets/img/avatar.png" alt="Author picture">
          </a>

          <div class="text-component text-sm line-height-xs text-space-y-xxs">
            <p><a href="#0" class="articles-v3__author-name" rel="author">sam mitcher</a></p>
            <p class="color-contrast-medium">3 days go</p>
          </div>
        </div>

         <!-- Edit -->
         <div class="flex flex-wrap items-center justify-between margin-right-sm">
           <div class="flex flex-wrap">
             <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">
               <li class="menu-bar__item"><a href="/admin/posts/create" role="menuitem">
                 <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                   <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
                 </svg>
                 </a>
                 <span class="menu-bar__label">Edit Post</span>
               </li>
             </menu>

             <!-- Delete -->
             <li class="menu-bar__item" role="menuitem">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                  <g><path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path><path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path></g>
                </svg>
                <span class="menu-bar__label">Delete</span>
              </li>

           </div>
         </div>
       </div>

    <!-- Status Body -->
    <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
      <p class="padding-sm text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis! Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
      
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

                       <span>120 Favorited</span>
                   </button>
               </li>

               <li class="card-v10__social-item">
                   <button class="reset card-v10__social-btn js-tab-focus" aria-label="Comment">
                       <svg class="icon" viewBox="0 0 12 12">
                           <g>
                               <path d="M6,0C2.691,0,0,2.362,0,5.267s2.691,5.266,6,5.266a6.8,6.8,0,0,0,1.036-.079l2.725,1.485A.505.505,0,0,0,10,12a.5.5,0,0,0,.5-.5V8.711A4.893,4.893,0,0,0,12,5.267C12,2.362,9.309,0,6,0Z"></path>
                           </g>
                       </svg>
                       <span>54 Comments</span>
                   </button>
               </li>

           </ul>
       </footer>
    </div>

    <!-- 👇 Col 3 -->
    <div class="col-3@md">
      @include('admin.partials.sidebar')
    </div>
    
  </div><!-- Grid END -->
</div>

@endsection