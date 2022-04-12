@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.comments.script-js')
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

                <li class="breadcrumbs__item color-contrast-high" aria-current="page">Comments</li>
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

                  <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar delete-selected-comments">
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

              <div id="delete-comment-dialog" class="dialog dialog--sticky js-dialog" data-animation="on">
                  <div class="dialog__content max-width-xxs" role="alertdialog" aria-labelledby="dialog-sticky-title" aria-describedby="dialog-sticky-description">
                      <div class="text-component">
                          <h4 id="dialog-sticky-title">Are you sure what you want to delete selected comment(-s)?</h4>
                          <p id="dialog-sticky-description">This action cannot be undone.</p>
                      </div>

                      <footer class="margin-top-md">
                          <div class="flex justify-end gap-xs flex-wrap">
                              <button class="btn btn--subtle js-dialog__close">Cancel</button>
                              <button id="accept-delete" class="btn btn--accent">Delete</button>
                          </div>
                      </footer>

                      <input type="hidden" id="delete-comments-list">
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
                        <div class="custom-checkbox int-table__checkbox comments-list-checkbox-all">
                          <input class="custom-checkbox__input js-int-table__select-all user-list-checkbox-all" type="checkbox" aria-label="Select all rows" />
                          <div class="custom-checkbox__control" aria-hidden="true"></div>
                        </div>
                      </td>

                      <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                      @if(request()->get('sortBy') === 'user_id')
                      @if(request()->get('sortDesc') === 'desc')
                          int-table__cell--desc
                        @endif
                      @if(request()->get('sortDesc') === 'asc')
                          int-table__cell--asc
                        @endif
                      @endif
                          " data-sort-col="user_id">
                        <div class="flex items-center">
                          <span>Users</span>

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
                      @if(request()->get('sortBy') === 'the_comment')
                      @if(request()->get('sortDesc') === 'desc')
                          int-table__cell--desc
                        @endif
                      @if(request()->get('sortDesc') === 'asc')
                          int-table__cell--asc
                        @endif
                      @endif
                          " data-sort-col="the_comment">
                        <div class="flex items-center">
                          <span>Comments</span>

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
                    @foreach($comments as $comment)
                    <tr class="int-table__row">
                      <th class="int-table__cell" scope="row">
                        <div class="custom-checkbox int-table__checkbox">
                          <input class="custom-checkbox__input js-int-table__select-row comment-list-checkbox" data-comment-id="{{$comment->id}}" type="checkbox" aria-label="Select this row" />
                          <div class="custom-checkbox__control" aria-hidden="true"></div>
                        </div>
                      </th>
                      <td class="int-table__cell flex">
                      <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
                        <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
                      </figure>
                      <div class="line-height-xs padding-top-xxxs">
                        <div class=""><a href="#" class="link-subtle">{{ \Illuminate\Support\Str::limit($comment->user()->name, 10) }}</a></div>
                      </div>
                      </td>

                      <td class="int-table__cell">
                      <div class=""><a href="{{ route('admin.comments.edit', $comment) }}" class="link-subtle">{{ \Illuminate\Support\Str::limit($comment->the_comment, 140) }}</a></div>
                      </td>
                      <td class="int-table__cell color-contrast-low">{{ $comment->created_at->diffForHumans() }}</td>
                      <td class="int-table__cell">
                      <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example-{{$comment->id}}">
                          <svg class="icon" viewBox="0 0 16 16">
                            <circle cx="8" cy="7.5" r="1.5" />
                            <circle cx="1.5" cy="7.5" r="1.5" />
                            <circle cx="14.5" cy="7.5" r="1.5" />
                          </svg>
                        </button>

                      </td>
                    </tr>
                    <!-- Action Dropdown -->
                    <menu id="menu-example-{{$comment->id}}" class="menu js-menu">

                        <li role="menuitem">
                          <span class="menu__content js-menu__content">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                            <path d="M11.87 5.71c-0.1-0.15-2.38-3.72-5.89-3.72s-5.8 3.57-5.9 3.72a0.5 0.5 0 0 0 0 0.53c0.1 0.15 2.38 3.72 5.9 3.72s5.8-3.57 5.89-3.72a0.5 0.5 0 0 0 0-0.53z m-5.89 3.25c-2.46 0-4.3-2.21-4.88-2.98a8.31 8.31 0 0 1 2.93-2.53 2.47 2.47 0 0 0-0.54 1.53 2.49 2.49 0 0 0 4.98 0 2.47 2.47 0 0 0-0.54-1.52 8.36 8.36 0 0 1 2.92 2.52c-0.57 0.78-2.41 2.99-4.87 2.98z"></path>                            </svg>
                            <span><a class="text-decoration-none color-inherit" href="{{ route('post.show', $comment->relatedPost()) }}" target="_blank">View Post</a></span>
                          </span>
                        </li>

                        <li role="menuitem">
                          <span class="menu__content js-menu__content">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                              <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
                              <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
                            </svg>
                            <span class="delete-comment-context-menu" data-comment-id="{{ $comment->id }}">Delete</span>
                          </span>
                        </li>
                    </menu>
                    <!-- Action Dropdown END-->
                    @endforeach
                </table>
              </div>
            </div>
          </div>
            <!-- Pagination -->
            @include('components.layouts.partials.pagination', ['items' => $comments])
            <!-- Pagination END-->
          <!-- END Table-->

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>
@endsection
