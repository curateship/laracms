@extends('admin.layouts.app')
@section('content')

  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
            <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
              <ol class="flex flex-wrap gap-xxs">

                <li class="breadcrumbs__item color-contrast-low">
                  <a href="/admin" class="color-inherit link-subtle">Home</a>
                  <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                </li>

                <li class="breadcrumbs__item color-contrast-low">
                  <a href="/admin/comments" class="color-inherit link-subtle">Comments</a>
                  <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                </li>

                <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit </li>
              </ol>
            </nav>
              </div>

              <!-- Menu Bar -->
              <div class="flex flex-wrap items-center justify-between margin-right-sm">
                <div class="flex flex-wrap">
                  <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">

                    <li class="menu-bar__item" role="menuitem">
                      <a class="text-decoration-none color-inherit" href="{{ route('post.show', $comment->relatedPost()) }}" target="_blank">
                        <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M19.79 9.52c-0.16-0.25-3.96-6.2-9.83-6.2s-9.67 5.95-9.83 6.2a0.83 0.83 0 0 0 0 0.88c0.16 0.25 3.96 6.2 9.83 6.2s9.67-5.95 9.83-6.2a0.83 0.83 0 0 0 0-0.88z m-9.83 5.42c-4.1 0-7.17-3.69-8.12-4.98a13.85 13.85 0 0 1 4.87-4.21 4.11 4.11 0 0 0-0.9 2.55 4.15 4.15 0 0 0 8.3 0 4.11 4.11 0 0 0-0.89-2.54 13.94 13.94 0 0 1 4.86 4.2c-0.95 1.3-4.01 4.98-8.12 4.98z"></path>
                        </svg>
                        <span class="menu-bar__label">View Post</span>
                        </a>
                    </li>

                    <li class="menu-bar__item" role="menuitem" aria-controls="post-search">
                      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
                      </svg>
                      <span class="menu-bar__label">Search Comments</span>
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
          </div>
          <!-- END Control Bar-->

          <div class="margin-top-auto border-top border-contrast-lower border-opacity-30%"></div><!-- Divider -->
            <div class="padding-md">
              <form action="{{ route('admin.comments.update', $comment) }}" method='post'>
                @csrf
                @method('PATCH')

              <div>
                <textarea class="margin-bottom-sm form-control width-100%" name="the_comment" id="post_comment" placeholder="Enter a Comment" rows="5">{{ old("the_comment", $comment->the_comment) }}</textarea>
              </div>

              @error('the_comment')
              <p>{{ $message }}</p>
              @enderror

                <div class="flex justify-end gap-xs">
                      <button class="btn btn--primary">Update</button>
                    </div>
                </form>
              </div>

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
          @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
              @include('admin.partials.sidebar-admin')
          @else
              @include('admin.partials.sidebar')
          @endif
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>

@endsection
