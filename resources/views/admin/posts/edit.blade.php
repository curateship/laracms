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
    @include('admin.posts.script-multi-upload')
    @include('admin.posts.jquery-ui')
@endpush

@section('content')
<!-- 👇 Content Body Wrapper-->
@include('admin.partials.modal')
<div class="grid gap-md justify-between">

  <!-- Bread Crumb Mobile -->
  <nav class="breadcrumbs text-based hide@md" aria-label="Breadcrumbs">
    <ol class="flex flex-wrap gap-xxs">
      <li class="breadcrumbs__item color-contrast-low">
        <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : '/'}}" class="color-inherit link-subtle">Home</a>
        <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
      </li>
      <li class="breadcrumbs__item color-contrast-low">
        <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/posts" class="color-inherit link-subtle">Posts</a>
        <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
      </li>
      <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit {{ \Str::limit( $post->title, 60) }}</li>
    </ol>
  </nav>

  <div class="col-12@md">

    <!-- Content Table Column -->
    <div class="card" data-table-controls="table-1">

    <!-- Control Bar -->
    <div class="controlbar--sticky flex justify-between">
        <div class="inline-flex items-baseline">

          <!-- Bread Crumb -->
          <nav class="breadcrumbs text-based padding-left-sm padding-sm display@md" aria-label="Breadcrumbs">
            <ol class="flex flex-wrap gap-xxs">
              <li class="breadcrumbs__item color-contrast-low">
                <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : '/'}}" class="color-inherit link-subtle">Home</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-low">
                <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/posts" class="color-inherit link-subtle">Posts</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit {{ \Str::limit( $post->title, 60) }}</li>
            </ol>
          </nav>
    </div>

    <!-- Menu Bar -->
    <div class="flex flex-wrap items-center justify-between margin-right-sm">
      <div class="flex flex-wrap">
        <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">

        <li class="menu-bar__item" role="menuitem">
          <a class="text-decoration-none color-inherit" href="{{ route('post.show', $post) }}" target="_blank">
            <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
            <path d="M19.79 9.52c-0.16-0.25-3.96-6.2-9.83-6.2s-9.67 5.95-9.83 6.2a0.83 0.83 0 0 0 0 0.88c0.16 0.25 3.96 6.2 9.83 6.2s9.67-5.95 9.83-6.2a0.83 0.83 0 0 0 0-0.88z m-9.83 5.42c-4.1 0-7.17-3.69-8.12-4.98a13.85 13.85 0 0 1 4.87-4.21 4.11 4.11 0 0 0-0.9 2.55 4.15 4.15 0 0 0 8.3 0 4.11 4.11 0 0 0-0.89-2.54 13.94 13.94 0 0 1 4.86 4.2c-0.95 1.3-4.01 4.98-8.12 4.98z"></path>
            </svg>
            <span class="menu-bar__label">Preview Post</span>
            </a>
          </li>

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
  <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
  <div class="padding-md">
  <form id="new-post-form" action="{{ route('post.store') }}" method='POST'>
    @csrf
    <input type="hidden" name="postId" value="{{$post->id}}">

    <fieldset class="margin-bottom-md">

      <div class="margin-bottom-sm">
          <input class="form-control width-100%" type="text" name="title" placeholder="Enter Your Title" value="{{$post->title}}" required>
      </div>

      @error('title')
      <p>{{ $message }}</p>
      @enderror

      <div>
          <div id="js-editor-description" data-target-input="#description" data-post-body="{{$post->body}}" class="site-editor form-control width-100%"></div>
          <input type="hidden" name="description" id="description" required/>
      </div>

      <!-- Date Picker -->
      <div class="date-input js-date-input margin-y-sm">

      <div class="date-input__wrapper">
        <input type="text" class="form-control width-100% date-input__text js-date-input__text" placeholder="dd/mm/yyyy" autocomplete="off" id="date-input-1" name="post_date" value="{{$post->post_date != '' ? date('d/m/Y', strtotime($post->post_date)) : ''}}">

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
            <option value="{{ $key }}" {{$key == $post->category_id ? 'selected' : ''}}>{{ $category }}</option>
            @endforeach
          </optgroup>
        </select>

        <!-- input -->
        <div class="select-auto__input-wrapper">
          <input class="form-control js-autocomplete__input js-select-auto__input" value="{{\App\Models\Category::find($post->category_id)->name}}" type="text" name="category" placeholder="Select a Category" autocomplete="off" required>

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

        <!-- Tags -->
        @foreach(\App\Models\TagsCategories::all() as $key=> $tag_category)
            <div class="grid margin-bottom-sm">
                <label class="form-label" for="tag_category_{{ $tag_category->id }}">
                </label>
                <select name="tag_category_{{ $tag_category->id }}[]" id="tag_category_{{ $tag_category->id }}" class="site-tag-pills" data-category-id="{{ $tag_category->id }}" data-placeholder="Edit {{ $tag_category->name }}" multiple>
                    @foreach($post->tags($tag_category->id) as $tag)
                        <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                    @endforeach()
                </select>
            </div>
        @endforeach
        <!--
        <div class="margin-bottom-sm tags-container">
            <label>
                <select name="tags[]" id="tags_pills" class="site-tag-pills form-control" multiple style="display: none" data-placeholder="Select a Tags">
                    @foreach($post->tags() as $tag)
                        <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                    @endforeach()
                </select>
            </label>
        </div>
        -->
        <!-- Tags END -->

        @if(in_array($post->type, ['image', 'video', 'news', 'review']))
            <!-- Image Upload -->

            <div class="file-upload inline-block margin-bottom-sm">
                <label for="upload-file" class="file-upload__label btn btn--subtle">
                    <span class="flex items-center">
                      <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>

                      <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Edit media</span>
                    </span>
                </label>

                <input type="hidden" name="original" value="{{$post->original}}"/>
                <input type="hidden" name="thumbnail" value="{{$post->thumbnail}}"/>
                <input type="hidden" name="medium" value="{{$post->medium}}"/>

                <input type="hidden" name="type" value="{{$post->type}}"/>

                <input type="hidden" name="video_original" value="{{$post->video_original}}"/>
                <input type="hidden" name="video_thumbnail" value="{{$post->video_thumbnail}}"/>
                <input type="hidden" name="video_medium" value="{{$post->video_medium}}"/>

                <input type="file" class="file-upload__input" name="image" id="upload-file" accept="{{$post->type == 'image' ? 'image/jpeg, image/jpg, image/png, image/gif' : 'video/mp4, video/webm'}}">

                <br>

                <div id="uploading-progress-bar" class="progress-bar progress-bar--color-update flex flex-column items-center js-progress-bar margin-top-md" style="display: none;">
                    <div class="progress-bar__bg " aria-hidden="true">
                        <div class="progress-bar__fill " style="width: 0%;"></div>
                    </div>
                </div>

                <div id="upload-thumbnail" class="margin-top-md">
                    {!! $content !!}
                </div>
            </div>
            <!-- Image Upload END -->
        @endif

        @if($post->type == 'gallery')
            @include('admin.forms.gallery', ['post' => $post])
        @endif


    </fieldset>

      <div class="flex gap-sm justify-end">
          <input type="hidden" name="status" value="">

          <div class="flex justify-end gap-xs">
              <button type="button" class="btn btn--accent" id="delete-post-from-edit-page">Delete post</button>
          </div>

          <div class="flex justify-end gap-xs">
              <button class="btn btn--primary">Save changes</button>
          </div>

          @if($post->status == 'published' || $post->status == 'pre-published' || $post->status == 'trash')
              <div class="flex justify-end gap-xs">
                  <button class="btn btn--primary postSaveAs" data-status="draft">Move to drafts</button>
              </div>
          @endif

          @if($post->status == 'draft')
              <div class="flex justify-end gap-xs">
                  <button class="btn btn--primary postSaveAs" data-status="published">Publish</button>
              </div>
          @endif
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
  </div>
</div>

@endsection
