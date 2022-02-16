@extends('admin.layouts.app')
@section('content')

<section class="margin-y-xl">
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

            <!-- Select Category Dropdown Autocomplete -->
            <div class="autocomplete position-relative select-auto js-select-auto js-autocomplete margin-bottom-sm" data-autocomplete-dropdown-visible-class="autocomplete--results-visible">

              <!-- select -->
              <select required name="post_id" class="js-select-auto__select">
                <optgroup>
                @foreach($posts as $key => $post)
                <option {{ $comment->post_id === $key ? 'selected' : '' }} value="{{ $key }}">{{ $post }}</option>
                @endforeach
                </optgroup>
              </select>

              @error('post_id')
                <p>{{ $message }}</p>
              @enderror

                <!-- input -->
                <div class="select-auto__input-wrapper">
                  <input class="form-control js-autocomplete__input js-select-auto__input" type="text" name="autocomplete-input-id" id="autocomplete-input-id" placeholder="Select a Post" autocomplete="off">

                  <div class="select-auto__input-icon-wrapper">
                    <!-- arrow icon -->
                    <svg class="icon" viewBox="0 0 16 16">
                      <title>Open selection</title>
                      <polyline points="1 5 8 12 15 5" fill="none" stroke="gray" opacity="30%" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>

                    <!-- close X icon -->
                    <button class="reset select-auto__input-btn js-select-auto__input-btn js-tab-focus">
                      <svg class="icon" viewBox="0 0 16 16">
                        <title>Reset selection</title>
                        <path d="M8,0a8,8,0,1,0,8,8A8,8,0,0,0,8,0Zm3.707,10.293a1,1,0,1,1-1.414,1.414L8,9.414,5.707,11.707a1,1,0,0,1-1.414-1.414L6.586,8,4.293,5.707A1,1,0,0,1,5.707,4.293L8,6.586l2.293-2.293a1,1,0,1,1,1.414,1.414L9.414,8Z" />
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- dropdown -->
                <div class="autocomplete__results select-auto__results js-autocomplete__results">
                  <ul id="autocomplete1" class="autocomplete__list js-autocomplete__list">
                    <li class="select-auto__group-title padding-y-xs padding-x-sm color-contrast-medium is-hidden js-autocomplete__result" data-autocomplete-template="optgroup" role="presentation">
                      <span class="text-truncate text-sm" data-autocomplete-label></span>
                    </li>

                    <li class="select-auto__option padding-y-xs padding-x-sm is-hidden js-autocomplete__result" data-autocomplete-template="option">
                      <span class="is-hidden" data-autocomplete-value></span>
                      <div class="text-truncate" data-autocomplete-label></div>
                    </li>

                    <li class="select-auto__no-results-msg padding-y-xs padding-x-sm text-truncate is-hidden js-autocomplete__result" data-autocomplete-template="no-results" role="presentation"></li>
                  </ul>
                </div>

                <p class="sr-only" aria-live="polite" aria-atomic="true"><span class="js-autocomplete__aria-results">0</span> results found.</p>
              </div>
              <!-- Select Category Dropdown Autocomplete END -->

                <div class="flex justify-end gap-xs">
                      <button class="btn btn--primary">Update</button>
                    </div>
                </form>
              </div>

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        <x-admin.sidebar/>
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>
</section

@endsection
