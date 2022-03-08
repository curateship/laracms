@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.posts.script-editor-js')
    @include('admin.posts.script-editor-js-image')
    @include('admin.posts.script-editor-js-header')
    @include('admin.posts.script-editor-js-embed')
    @include('admin.posts.script-editor-js-list')
    @include('admin.posts.script-js')
    @include('admin.posts.script-select2-js')
@endpush

@section('content')
<!-- 👇 Content Body Wrapper-->
<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">
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
                <a href="/admin" class="color-inherit link-subtle">Home</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-low">
                <a href="/admin/posts" class="color-inherit link-subtle">Posts</a>
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
        </div><!-- END Control Bar -->
      </div>
  </div><!-- END card -->
  <!-- END Control Bar-->

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
      <!-- Select Category Dropdown Autocomplete -->
      <div class="autocomplete position-relative select-auto js-select-auto js-autocomplete margin-bottom-sm" data-autocomplete-dropdown-visible-class="autocomplete--results-visible">
        <!-- select -->
        <select class="js-select-auto__select">
          <optgroup>
            @foreach($categories as $key => $category)
            <option value="{{ $key }}">{{ $category }}</option>
            @endforeach
          </optgroup>
        </select>
        <!-- input -->
        <div class="select-auto__input-wrapper">
          <input class="form-control js-autocomplete__input js-select-auto__input" type="text" name="category" placeholder="Select a Category" autocomplete="off" required>
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
              <select name="tag_category_{{ $tag_category->id }}[]" id="tag_category_{{ $tag_category->id }}" class="site-tag-pills form-control" data-id="{{ $tag_category->id }}" data-placeholder="Add {{ $tag_category->name }}" multiple></select>
          </div>
      @endforeach
      <!--
      <div class="margin-bottom-sm tags-container">
          <label>
              <select name="tags[]" id="tags_pills" class="site-tag-pills form-control" multiple style="display: none" data-placeholder="Select a Tags"></select>
          </label>
      </div>
      -->
      <!-- Tags END -->
      <!-- Image Upload -->
      <div class="file-upload inline-block margin-bottom-sm">
        <label for="upload-file" class="file-upload__label btn btn--subtle">
          <span class="flex items-center">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
            <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload Image</span>
          </span>
        </label>
          <input type="hidden" name="original" value=""/>
          <input type="hidden" name="thumbnail" value=""/>
          <input type="hidden" name="medium" value=""/>
          <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif" required>
          <br>
          <img alt="thumbnail" id="upload-thumbnail" class="margin-top-md" src="" style="display: none;">
      </div>
    </fieldset>
    <div class="flex justify-end gap-xs">
      <button class="btn btn--primary">Publish</button>
    </div>
    </form>
  </div>
  <!-- END Table-->

      </div><!-- END Col-12 Card Wrapper -->
    </div><!-- Col-12 END -->
    <!-- Sidebar -->
    <div class="col-3@md">
      @include('admin.partials.sidebar')
    </div>
    <!-- Sidebar END -->
  </div><!-- Grid END (col-12 and col-3) -->
</div><!-- Container Wrapper END -->
@endsection
