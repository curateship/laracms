@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.favorites.script-js')
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
                    <a href="/admin/favorites" class="color-inherit link-subtle">Favorites</a>
                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                  </li>

                  <li class="breadcrumbs__item color-contrast-high" aria-current="page">Edit List 1</li>
                </ol>
              </nav>
              <!-- Bread Crumb END -->
        </div>
        <!-- END Control Bar-->

    <!-- Menu Bar -->
    <div class="flex flex-wrap items-center justify-between margin-right-sm">
      <div class="flex flex-wrap">
        <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">

          <li class="menu-bar__item" role="menuitem" aria-controls="favorite-search">
            <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
              <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
            </svg>
            <span class="menu-bar__label">Search Lists</span>
          </li>
            <!-- Search Modal -->
            <div class="modal modal--search modal--animate-fade bg bg-opacity-90% flex flex-center padding-md backdrop-blur-10 js-modal" id="favorite-search">
                <div class="modal__content width-100% max-width-sm max-height-100% overflow-auto" role="alertdialog" aria-labelledby="modal-search-title" aria-describedby="">
                    <form class="full-screen-search">
                        <label for="search" id="modal-search-title" class="sr-only">Search</label>
                        <input class="reset full-screen-search__input" type="search" name="search" id="search" placeholder="Search...">
                        <button class="reset full-screen-search__btn">
                            <svg class="icon" viewBox="0 0 24 24">
                                <title>Search</title>
                                <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none" stroke-miterlimit="10">
                                    <line x1="22" y1="22" x2="15.656" y2="15.656"></line>
                                    <circle cx="10" cy="10" r="8"></circle>
                                </g>
                            </svg>
                        </button>
                    </form>
                </div>

                <button class="reset modal__close-btn modal__close-btn--outer  js-modal__close js-tab-focus">
                    <svg class="icon icon--sm" viewBox="0 0 24 24">
                        <title>Close modal window</title>
                        <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="3" x2="21" y2="21" />
                            <line x1="21" y1="3" x2="3" y2="21" />
                        </g>
                    </svg>
                </button>
            </div>

        </menu>

      </div><!-- END Control Bar -->
    </div>
  </div><!-- END card -->
<!-- END Control Bar-->

<!-- Table-->
<div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
<div class="padding-md">
<form action="{{ route('admin.favorites.store') }}" method='post' id="favorite-form">
    @csrf
  <fieldset class="margin-bottom-xxs">
      <input type="hidden" name="favoriteId" value="{{$favorite->id}}">

    <div class="margin-bottom-sm">
      <input class="form-control width-100%" type="text" value='{{$favorite->name}}' name="name" id="inputtitle" placeholder="Edit List Title" required>
    </div>
    @error('title')
    <p>{{ $message }}</p>
    @enderror

      <div class="form-group margin-bottom-xs" style="display: flex;gap: 20px;align-items: center;">
          <input class="radio" type="radio" name="public" value="1" id="fav-public" {{$favorite->public == 1 ? 'checked' : ''}}>
          <label for="fav-public">Public</label>

          <input class="radio" type="radio" name="public" value="0" id="fav-private" {{$favorite->public == 0 ? 'checked' : ''}}>
          <label for="fav-private">Private</label>
      </div>


      <div class="flex justify-start gap-lg padding-top-sm">
          <!-- Edit Avatar -->
          <div class="file-upload inline-block">
              <label for="image-upload-file" class="file-upload__label btn btn--subtle">
                <span class="flex items-center">
                  <svg class="icon" viewBox="0 0 20 20" aria-hidden="true">
                    <g fill="currentColor">
                      <path d="M18 12v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13V2"></path>
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7l5-5 5 5"></path>
                    </g>
                  </svg>

                  <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Edit Image</span>
                </span>
              </label>

              <input type="hidden" name="original" value="{{$favorite->original}}"/>
              <input type="hidden" name="thumbnail" value="{{$favorite->thumbnail}}"/>
              <input type="hidden" name="medium" value="{{$favorite->medium}}"/>

              <input type="file" class="file-upload__input" name="image" id="image-upload-file" accept="image/jpeg, image/jpg, image/png, image/gif">

              <br><br>

              <div class="author author--featured padding-bottom-sm">
                  <div class="author__img-wrapper">
                      <img alt="thumbnail" id="upload-image" src="{{url('/storage'.config('images.lists_storage_path').$favorite->thumbnail)}}" style="{{$favorite->thumbnail == '' ? 'display: none' : ''}}">
                  </div>
              </div>
          </div>
      </div>

      <div class="flex gap-sm justify-end">
          <input type="hidden" name="status" value="">

          <button class="btn btn--accent postSaveAs" data-status="delete">Delete</button>
          <button class="btn btn--primary btn--md width-15%">Update</button>
      </div>

  </fieldset>
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
