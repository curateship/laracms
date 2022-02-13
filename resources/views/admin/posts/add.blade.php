@extends('apps.master')
@section('content')
  
<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg padding-top-sm">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

        <!-- Content Table Column -->
        <div class="card">
          
        <!-- Control Bar -->
        <div class="controlbar--sticky flex justify-between">
          <div class="">
            <div class="inline-flex items-baseline">

              <!-- Bread Crumb -->
              <nav class="breadcrumbs text-sm padding-left-sm padding-sm" aria-label="Breadcrumbs">
                <ol class="flex flex-wrap gap-xxs">
                  <li class="breadcrumbs__item">
                    <a href="/admin" class="color-inherit link-subtle">Home</a>
                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                  </li>

                  <li class="breadcrumbs__item">
                    <a href="/admin/posts" class="color-inherit link-subtle">Post</a>
                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                  </li>

                  <li class="breadcrumbs__item" aria-current="page">Add Post</li>
                  
                </ol>
              </nav>
              <!-- Bread Crumb END -->

            </div>
        </div>
        <!-- END Control Bar-->

        <!-- Menu Bar -->
        <div class="flex flex-wrap items-center justify-between margin-right-sm">
          <div class="flex flex-wrap">
            <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">
              <li class="menu-bar__item" role="menuitem" aria-controls="create-modal">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                  <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
                </svg>
                <span class="menu-bar__label">Add Post</span>
              </li>
              <li class="menu-bar__item" role="menuitem" aria-controls="post-search">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                  <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
                </svg>
                <span class="menu-bar__label">Search Posts</span>
              </li>
            </menu>
            <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar">
              <li class="menu-bar__item" role="menuitem">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                  <g><path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path><path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path></g>
                </svg>
                <span class="counter counter--critical counter--docked">4 <i class="sr-only">Notifications</i></span>
                <span class="menu-bar__label">Delete</span>
              </li>
              </menu>
            </div>
          </div>
          <!-- Menu Bar -->

        </div><!-- Control bar END -->
        <div class="margin-top-auto border-top border-contrast-lower"></div>
        <!-- Divider -->

        <!-- Add Content Box -->
        <div class="padding-sm">
        <form>
          <fieldset class="margin-bottom-md">

            <div class="margin-bottom-xs">
              <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter Your Title">
            </div>

            <div>
              <textarea class="form-control width-100% height-550" name="textarea" id="textarea" placeholder="Enter Discription"></textarea>
            </div>

            <label class="form-label margin-bottom-xxs margin-top-md" for="lastName">Enter Tags</label>
            <div class="margin-bottom-xs">
              <input class="form-control width-100%" type="name" name="inputname" id="inputname" placeholder="Enter a tag">
            </div>
          </fieldset>
        </form>
        </div>
        <!-- Add Content Box END -->

        </div><!-- END Col-12 Card Wrapper -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection