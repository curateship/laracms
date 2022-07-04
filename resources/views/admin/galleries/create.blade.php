@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.posts.script-editor-js')
    @include('admin.posts.script-editor-js-image')
    @include('admin.posts.editorjs-custom-ext-url.custom-ext')
    @include('admin.posts.script-editor-js-header')
    @include('admin.posts.script-editor-js-embed')
    @include('admin.posts.script-editor-js-list')
    @include('admin.galleries.script-multi-upload')
    @include('admin.galleries.script-js')
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
                <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : '/'}}" class="color-inherit link-subtle">Home</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>
              <li class="breadcrumbs__item color-contrast-low">
                <a href="{{\Illuminate\Support\Facades\Gate::allows('is-admin') ? '/admin' : ''}}/galleries" class="color-inherit link-subtle">Galleries</a>
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
            <li class="menu-bar__item" role="menuitem" aria-controls="gallery-search">
              <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
              </svg>
              <span class="menu-bar__label">Search Galleries</span>
            </li>
          </menu>
        </div><!-- END Control Bar -->
      </div>
  </div><!-- END card -->
  <!-- END Control Bar-->

  <!-- Table-->
  <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
    <div class="padding-md">
    <form method="POST" action="{{ route('gallery.store') }}" id="new-gallery-form">
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

      <!-- Select Category Dropdown Autocomplete -->
      <div class="autocomplete position-relative select-auto js-select-auto js-autocomplete margin-bottom-sm" data-autocomplete-dropdown-visible-class="autocomplete--results-visible">

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

      <div id="uploads-box">

      </div>

    </fieldset>

        <div class="file-upload inline-block margin-bottom-sm">
            <label for="upload-file" class="file-upload__label btn btn--subtle">
                <span class="flex items-center">
                  <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
                  <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload Gallery Image</span>
                </span>
            </label>
            <input type="hidden" name="original" value=""/>
            <input type="hidden" name="thumbnail" value=""/>
            <input type="hidden" name="medium" value=""/>
            <input type="hidden" name="type" value=""/>
            <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif, image/gif" required>
            <br>
            <div id="uploading-progress-bar" class="progress-bar progress-bar--color-update flex flex-column items-center js-progress-bar margin-top-md" style="display: none;">
                <div class="progress-bar__bg " aria-hidden="true">
                    <div class="progress-bar__fill " style="width: 0%;"></div>
                </div>
            </div>
            <div id="upload-thumbnail" class="margin-top-md"></div>
        </div>


        <div class="row">
            <div id="preview-box">

            </div>


            <div class="col-md-6 col-sm-12">

            <!-- Our markup, the important part here! -->
            <div id="drag-and-drop-zone" class="dm-uploader p-5">
                <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                <div class="btn btn-primary btn-block mb-5">
                    <span>Open the file Browser</span>
                    <input type="file" title='Click to add Files' accept="image/jpeg, image/jpg, image/png, image/gif, image/gif"/>
                </div>
            </div><!-- /uploader -->

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="class card h-100 files-box">
                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                        <li class="text-muted text-center empty">No files uploaded.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- File item template -->
        <script type="text/html" id="files-template">
            <li class="media">
                <div class="media-body mb-1">
                    <p class="mb-2">
                        <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                    </p>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary upload-progress"
                             role="progressbar"
                             style="width: 0%"
                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <hr class="mt-1 mb-1" />
                </div>
            </li>
        </script>

        <!-- Debug item template -->
        <script type="text/html" id="debug-template">
            <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
        </script>


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
  <!-- END Table-->

      </div><!-- END Col-12 Card Wrapper -->
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
  </div><!-- Grid END (col-12 and col-3) -->
</div><!-- Container Wrapper END -->
@endsection
