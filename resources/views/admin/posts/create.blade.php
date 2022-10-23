@extends(config('theme.admin_app_template'))

@push('custom-scripts')
    @include('admin.posts.script-select2-js')
    @include('admin.posts.script-editor-js')
    @include('admin.posts.script-editor-js-image')
    @include('admin.posts.editorjs-custom-ext-url.custom-ext')
    @include('admin.posts.script-editor-js-header')
    @include('admin.posts.script-editor-js-embed')
    @include('admin.posts.script-editor-js-list')
    @include('admin.posts.script-js')
@endpush

@section('content')

<div class="grid gap-md justify-between">
    @if(Auth::user()->status == 'active')

    <div class="col-12@md">
    <!-- Content Table Column -->
    <div class="card" data-table-controls="table-1">

    <!-- Control Bar -->
    <div class="controlbar--sticky flex justify-between">
      <div class="inline-flex items-baseline">

            <!-- Bread Crumb -->
            <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
              <ol class="flex flex-wrap gap-xxs">
                <li class="breadcrumbs__item color-contrast-low">
                  <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : '/'}}" class="color-inherit link-subtle">Home</a>
                  <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                </li>
                <li class="breadcrumbs__item color-contrast-low">
                  <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/posts" class="color-inherit link-subtle">Posts</a>
                  <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                </li>
                <li class="breadcrumbs__item color-contrast-high" aria-current="page">Create</li>
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
                <span class="menu-bar__label">Search Posts</span>
              </li>
            </menu>
          </div>
        </div>
    </div>

<!-- Table-->
<div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
  <div class="padding-md">
      <form method="POST" action="{{ route('post.store') }}" id="new-post-form">
      @csrf
      <fieldset class="margin-bottom-md">
        <div class="margin-bottom-sm">
          <input class="form-control width-100%" type="text" name="title" placeholder="Enter Your Title" required>
        </div>
          @error('title')
          <p>{{ $message }}</p>
          @enderror
        <div>
          <!--<textarea class="margin-bottom-sm form-control width-100%" name="description" id="" placeholder="Enter Description" rows="12"></textarea>-->
            <div id="js-editor-description" data-target-input="#description" class="site-editor margin-bottom-sm form-control width-100%"></div>
            <input type="hidden" name="description" id="description" required/>
        </div>
        <!-- Excerpt
        <textarea class="form-control width-100% margin-bottom-sm" type="text" name="excerpt" id="textarea" minlength="10" placeholder="Enter Your Excerpt" required>{{ old("excerpt") }}</textarea>
        @error('excerpt')
          <p>{{ $message }}</p>
        @enderror
          -->

        <!-- Date Picker -->
        <div class="date-input js-date-input margin-y-sm">
        <div class="date-input__wrapper">
          <input type="text" class="form-control width-100% date-input__text js-date-input__text" placeholder="dd/mm/yyyy" autocomplete="off" id="date-input-1" name="post_date">
          <button class="reset date-input__trigger js-date-input__trigger js-tab-focus" aria-label="Select date using calendar widget" type="button">
            <svg class="icon" aria-hidden="true" viewBox="0 0 20 20"><g fill="none" stroke="currentColor" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"><rect x="1" y="4" width="18" height="14" rx="1"/><line x1="5" y1="1" x2="5" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="1" y1="9" x2="19" y2="9"/></g></svg>
          </button>
        </div>
        <div class="date-picker js-date-picker" role="dialog" aria-labelledby="calendar-label-1">
          <header class="date-picker__header">
            <div class="date-picker__month">
              <span class="date-picker__month-label js-date-picker__month-label" id="calendar-label-1"></span> <!-- this will contain month label + year -->
              <nav>
                <ul class="date-picker__month-nav js-date-picker__month-nav">
                  <li>
                    <button class="reset date-picker__month-nav-btn js-date-picker__month-nav-btn js-date-picker__month-nav-btn--prev js-tab-focus" type="button">
                      <svg class="icon icon--xs" viewBox="0 0 16 16"><title>Previous month</title><polyline points="10 2 4 8 10 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </button>
                  </li>
                  <li>
                    <button class="reset date-picker__month-nav-btn js-date-picker__month-nav-btn js-date-picker__month-nav-btn--next js-tab-focus" type="button">
                      <svg class="icon icon--xs" viewBox="0 0 16 16"><title>Next month</title><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
            <ol class="date-picker__week">
              <li><div class="date-picker__day">M<span class="sr-only">onday</span></div></li>
              <li><div class="date-picker__day">T<span class="sr-only">uesday</span></div></li>
              <li><div class="date-picker__day">W<span class="sr-only">ednesday</span></div></li>
              <li><div class="date-picker__day">T<span class="sr-only">hursday</span></div></li>
              <li><div class="date-picker__day">F<span class="sr-only">riday</span></div></li>
              <li><div class="date-picker__day">S<span class="sr-only">aturday</span></div></li>
              <li><div class="date-picker__day">S<span class="sr-only">unday</span></div></li>
            </ol>
          </header>
          <ol class="date-picker__dates js-date-picker__dates" aria-labelledby="calendar-label-1">

          <!-- days will be created using js -->
          </ol>
        </div>
        </div>

        <!-- Select Category Dropdown Autocomplete -->
        <div class="autocomplete position-relative select-auto js-select-auto js-autocomplete margin-bottom-sm" data-autocomplete-dropdown-visible-class="autocomplete--results-visible">
          <!-- select -->
          <select class="js-select-auto__select">
            <optgroup>
              @foreach($categories as $key => $category)
              <option value="{{ $key }}" {{$key == 1 ? 'selected' : ''}}>{{ $category }}</option>
              @endforeach
            </optgroup>
          </select>

          <!-- input -->
          <div class="select-auto__input-wrapper">
            <input class="form-control js-autocomplete__input js-select-auto__input" value="Post" type="text" name="category" placeholder="Select a Category" autocomplete="off" required>
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

          <!-- contests -->
          <div class="autocomplete position-relative select-auto js-select-auto js-autocomplete margin-bottom-sm" data-autocomplete-dropdown-visible-class="autocomplete--results-visible" style="{{count(\App\Models\User::getUserContests()) == 0 ? 'display:none' : ''}}">
              <input type="hidden" value="" name="selected-contest" id="selected-contest">
              <!-- select -->
              <select class="js-select-auto__select" id="contests-list">
                  <optgroup>
                      @foreach(\App\Models\User::getUserContests() as $key => $contest)
                          <option value="{{ $contest->id }}">{{ $contest->title }}</option>
                      @endforeach
                  </optgroup>
              </select>

              <!-- input -->
              <div class="select-auto__input-wrapper">
                  <input class="form-control js-autocomplete__input js-select-auto__input" type="text" id="contests-list-input" name="contest" placeholder="Select a contest" autocomplete="off">
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

        <!-- Tags -->
        @foreach(\App\Models\TagsCategories::all() as $key=> $tag_category)
            <div class="grid margin-bottom-sm">
                <label class="form-label margin-bottom-xxxs" for="tag_category_{{ $tag_category->id }}">
                </label>
                <select name="tag_category_{{ $tag_category->id }}[]" id="tag_category_{{ $tag_category->id }}" class="site-tag-pills form-control" data-category-id="{{ $tag_category->id }}" data-placeholder="Add {{ $tag_category->name }}" multiple></select>
            </div>
        @endforeach

        <!-- Content Type Selection -->
        <div class="grid gap-sm items-center@md padding-top-xs">
              <div class="col-10@md">
                <ul class="flex flex-wrap gap-md">
                    @if(Gate::allows('is-admin'))
                        <li>
                            <input class="radio uploading-form-type" type="radio" name="type" id="news-uploading" value="news">
                            <label for="news-uploading">News</label>
                        </li>
                    @endif

                  <li>
                    <input class="radio uploading-form-type" type="radio" name="type" id="image-uploading" value="image">
                    <label for="image-uploading">Image</label>
                  </li>

                  <li>
                    <input class="radio uploading-form-type" type="radio" name="type" id="video-uploading" value="video">
                    <label for="video-uploading">Video</label>
                  </li>

                    <li>
                        <input class="radio uploading-form-type" type="radio" name="type" id="gallery-uploading" value="gallery">
                        <label for="gallery-uploading">Gallery</label>
                    </li>

                        <li>
                            <input class="radio uploading-form-type" type="radio" name="type" id="review-uploading" value="review">
                            <label for="review-uploading">Review</label>
                        </li>
                </ul>
              </div>

        <!-- Content Type Form -->
        <div class="padding-top-md" id="uploading-form">
        </div>
      </div>
      </fieldset>
      <div class="flex gap-sm justify-end">
          <input type="hidden" name="status" value="">
          <div class="flex justify-end gap-xs">
              <button type="button" class="btn btn--primary postSaveAs" data-status="draft">Save as draft</button>
          </div>
          <div class="flex justify-end gap-xs">
              <button type="button" class="btn btn--primary postSaveAs" data-status="published">Publish</button>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

  <!-- Sidebar -->
  <div class="col-3@md">
      @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
          @include('admin.partials.sidebar-admin')
      @else
          @include('admin.partials.sidebar')
      @endif
  </div>

  @else
        <div class="col-12@md">
            <aside class="note note--warning margin-bottom-md">
                <div class="flex items-center">
                    <svg class="icon icon--md margin-right-sm" viewBox="0 0 30 30">
                        <path d="M12.4 2.563L.377 24.518A3.023 3.023 0 0 0 3.006 29h23.987a3.023 3.023 0 0 0 2.632-4.477L17.66 2.569a2.992 2.992 0 0 0-5.26-.006z" fill="var(--color-warning-dark)" opacity=".25"></path>
                        <path fill="none" stroke="var(--color-warning-dark)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19v-9"></path>
                        <circle cx="15" cy="23.5" r="1.5" fill="var(--color-warning-dark)"></circle>
                    </svg>

                    <p class="note__title  color-contrast-higher"><strong>Your account is suspended</strong></p>
                </div>

                <div class="flex margin-top-xxxs">
                    <!-- spacer - occupy same space of icon above 👆 -->
                    <svg class="icon icon--md margin-right-sm" aria-hidden="true"></svg>

                    <div class="note__content text-component">
                        <!-- note content -->
                        <p>You cannot write comments and create new posts.</p>
                        <!-- end note content -->
                    </div>
                </div>
            </aside>
        </div>
  @endif

</div>
@endsection
