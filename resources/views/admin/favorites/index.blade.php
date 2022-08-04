@extends(env('MAIN_APP_TEMPLATE'))

@push('custom-scripts')
    @include('admin.favorites.script-js')
@endpush

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

              <li class="breadcrumbs__item color-contrast-high" aria-current="page">Favorites</li>
            </ol>
          </nav>
            </div>

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

                    <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar delete-selected-favorite">
                      <li class="menu-bar__item" role="menuitem">
                        <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                          <g><path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path><path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path></g>
                        </svg>
                        <span class="counter counter--critical counter--docked delete-counter">0 <i class="sr-only">Notifications</i></span>
                        <span class="menu-bar__label">Delete</span>
                      </li>
                    </menu>
                  </div>
                </div>

            <div id="delete-favorite-dialog" class="dialog dialog--sticky js-dialog" data-animation="on">
                <div class="dialog__content max-width-xxs" role="alertdialog" aria-labelledby="dialog-sticky-title" aria-describedby="dialog-sticky-description">
                    <div class="text-component">
                        <h4 id="dialog-sticky-title">Are you sure what you want to delete selected favorite(-s)?</h4>
                        <p id="dialog-sticky-description">This action cannot be undone.</p>
                    </div>

                    <footer class="margin-top-md">
                        <div class="flex justify-end gap-xs flex-wrap">
                            <button class="btn btn--subtle js-dialog__close">Cancel</button>
                            <button id="accept-delete" class="btn btn--accent">Delete</button>
                        </div>
                    </footer>

                    <input type="hidden" id="delete-favorite-list">
                </div>
            </div>
        </div>
        <!-- END Control Bar-->
        <div class="margin-top-auto border-top border-contrast-lower border-opacity-30%"></div><!-- Divider -->
        <!-- Table-->
        <div class="padding-sm">
          <div id="table-1" class="int-table text-sm js-int-table">
            <div class="int-table__inner margin-bottom-xs">
              <table class="int-table__table" aria-label="Interactive table example">
                <thead class="js-int-table__header">
                  <tr class="int-table__row">
                    <td class="int-table__cell">
                      <div class="custom-checkbox int-table__checkbox">
                        <input class="custom-checkbox__input js-int-table__select-all favorite-list-checkbox-all" type="checkbox" aria-label="Select all rows" />
                        <div class="custom-checkbox__control" aria-hidden="true"></div>
                      </div>
                    </td>

                    <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                        @if(request()->get('sortBy') === 'name')
                              @if(request()->get('sortDesc') === 'desc')
                                  int-table__cell--desc
                              @endif
                              @if(request()->get('sortDesc') === 'asc')
                                  int-table__cell--asc
                              @endif
                          @endif
                          " data-sort-col="name">
                      <div class="flex items-center">
                        <span>Name</span>

                        <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                          <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                          <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                      </div>

                      <ul class="sr-only js-int-table__sort-list">
                        <li>
                          <input type="radio" name="sortingName" id="sortingNameNone" value="none" checked>
                          <label for="sortingNameNone">No sorting</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingName" id="sortingNameAsc" value="asc">
                          <label for="sortingNameAsc">Sort in ascending order</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingName" id="sortingNameDes" value="desc">
                          <label for="sortingNameDes">Sort in descending order</label>
                        </li>
                      </ul>
                    </th>

                    <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                          @if(request()->get('sortBy') === 'posts_count')
                              @if(request()->get('sortDesc') === 'desc')
                                  int-table__cell--desc
                              @endif
                              @if(request()->get('sortDesc') === 'asc')
                                  int-table__cell--asc
                              @endif
                          @endif
                          " data-sort-col="posts_count">
                      <div class="flex items-center">
                        <span>Items</span>

                        <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                          <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                          <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                      </div>

                      <ul class="sr-only js-int-table__sort-list">
                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailNone" value="none" checked>
                          <label for="sortingEmailNone">No sorting</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailAsc" value="asc">
                          <label for="sortingEmailAsc">Sort in ascending order</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailDes" value="desc">
                          <label for="sortingEmailDes">Sort in descending order</label>
                        </li>
                      </ul>
                    </th>

                    <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                          @if(request()->get('sortBy') === 'public')
                              @if(request()->get('sortDesc') === 'desc')
                                  int-table__cell--desc
                              @endif
                              @if(request()->get('sortDesc') === 'asc')
                                  int-table__cell--asc
                              @endif
                          @endif
                          " data-sort-col="public">
                      <div class="flex items-center">
                        <span>Type</span>

                        <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                          <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                          <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                      </div>

                      <ul class="sr-only js-int-table__sort-list">
                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailNone" value="none" checked>
                          <label for="sortingEmailNone">No sorting</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailAsc" value="asc">
                          <label for="sortingEmailAsc">Sort in ascending order</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingEmail" id="sortingEmailDes" value="desc">
                          <label for="sortingEmailDes">Sort in descending order</label>
                        </li>
                      </ul>
                    </th>

                    <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                        @if(request()->get('sortBy') === 'created_at')
                              @if(request()->get('sortDesc') === 'desc')
                                  int-table__cell--desc
                              @endif
                              @if(request()->get('sortDesc') === 'asc')
                                  int-table__cell--asc
                              @endif
                          @endif
                          " data-sort-col="created_at" data-date-format="dd-mm-yyyy">
                      <div class="flex items-center">
                        <span>Date</span>

                        <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                          <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                          <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
                      </div>

                      <ul class="sr-only js-int-table__sort-list">
                        <li>
                          <input type="radio" name="sortingDate" id="sortingDateNone" value="none" checked>
                          <label for="sortingDateNone">No sorting</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingDate" id="sortingDateAsc" value="asc">
                          <label for="sortingDateAsc">Sort in ascending order</label>
                        </li>

                        <li>
                          <input type="radio" name="sortingDate" id="sortingDateDes" value="desc">
                          <label for="sortingDateDes">Sort in descending order</label>
                        </li>
                      </ul>
                    </th>

                    <th class="int-table__cell int-table__cell--th text-right">Action</th>
                  </tr>
                </thead>

                <tbody class="int-table__body js-int-table__body">
                @foreach($favorites as $favorite)
                    <tr class="int-table__row">
                        <th class="int-table__cell" scope="row">
                            <div class="custom-checkbox int-table__checkbox">
                                <input class="custom-checkbox__input js-int-table__select-row favorite-list-checkbox" type="checkbox" aria-label="Select this row" data-favorite-id="{{$favorite->id}}"/>
                                <div class="custom-checkbox__control" aria-hidden="true"></div>
                            </div>
                        </th>
                        <td class="int-table__cell flex">
                            <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
                                <img class="block width-100% height-100% object-cover" src="{{url('/storage').config('images.lists_storage_path').$favorite->thumbnail}}" alt="Author picture">
                            </figure>
                            <div class="line-height-xs padding-top-xxxs">
                                <div class="">
                                    <a href="/favorite/edit/{{ $favorite->id }}" class="link-subtle">{{$favorite->name}}</a>
                                </div>
                                <p class="color-contrast-medium"><a href="/user/{{$favorite->user->username}}" class="text-sm link-subtle">{{$favorite->user->name}}</a></p>
                            </div>
                        </td>
                        <td class="int-table__cell">{{$favorite->posts_count}}</td>
                        <td class="int-table__cell">{{$favorite->public == 1 ? 'Public' : 'Private'}}</td>

                        <td class="int-table__cell">{{ $favorite->created_at->diffForHumans() }}</td>
                        <td class="int-table__cell">
                            <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example">
                                <svg class="icon" viewBox="0 0 16 16">
                                    <circle cx="8" cy="7.5" r="1.5" />
                                    <circle cx="1.5" cy="7.5" r="1.5" />
                                    <circle cx="14.5" cy="7.5" r="1.5" />
                                </svg>
                            </button>

                            <!-- Action Dropdown -->
                            <menu id="menu-example" class="menu js-menu">
                                <li role="menuitem">
                                    <span class="menu__content js-menu__content">
                                      <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                                        <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                                      </svg>
                                      <a href="{{ route ('admin.favorites.edit', $favorite->id) }}" class="link-subtle">Edit</a>
                                    </span>
                                            </li>
                                            <li role="menuitem">
                                    <span class="menu__content js-menu__content">
                                      <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 16 16">
                                        <path d="M15,4H1C0.4,4,0,4.4,0,5v10c0,0.6,0.4,1,1,1h14c0.6,0,1-0.4,1-1V5C16,4.4,15.6,4,15,4z M14,14H2V6h12V14z"></path>
                                        <rect x="2" width="12" height="2"></rect>
                                      </svg>
                                      <a href="/lists/show/{{$favorite->slug}}" class="link-subtle">Preview</a>
                                    </span>
                                            </li>
                                            <li role="menuitem">
                                    <span class="menu__content js-menu__content">
                                      <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                                        <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
                                        <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
                                      </svg>
                                      <span class="delete-favorite-context-menu" data-favorite-id="{{ $favorite->id }}">Delete</span>
                                    </span>
                                </li>
                            </menu>
                            <!-- Action Dropdown END-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

          <!-- Pagination -->
          @include('components.layouts.partials.pagination', ['items' => $favorites])
          <!-- Pagination END-->

        <!-- END Table-->
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
