@extends('admin.layouts.app')

@push('custom-scripts')
  @include('admin.users.script-js')
@endpush

@section('content')
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md"><!-- 👇 Col 12 -->
        <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

          <!-- Control Bar -->
          <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">
                <!-- Breadcrumb -->
                <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
                  <ol class="flex flex-wrap gap-xxs">
                    <li class="breadcrumbs__item color-contrast-low">
                      <a href="/admin" class="color-inherit link-subtle">Home</a>
                      <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                    </li>
                    <li class="breadcrumbs__item color-contrast-high" aria-current="page">Users</li>
                  </ol>
                </nav>
              </div>

              <!-- Control -->
              <div class="flex flex-wrap items-center justify-between margin-right-sm">
                <div class="flex flex-wrap">

                  <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">
                    <li class="menu-bar__item"><a href="{{ route('admin.users.create') }}" role="menuitem">

                      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                          <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
                      </svg>
                      <span class="menu-bar__label">Add Post</span>
                      </a>
                    </li>

                    <li class="menu-bar__item" role="menuitem" aria-controls="post-search">
                      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
                      </svg>
                      <span class="menu-bar__label">Search Posts</span>
                    </li>
                  </menu>

                  <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar delete-selected-users">
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

              <div id="delete-user-dialog" class="dialog dialog--sticky js-dialog" data-animation="on">
                  <div class="dialog__content max-width-xxs" role="alertdialog" aria-labelledby="dialog-sticky-title" aria-describedby="dialog-sticky-description">
                      <div class="text-component">
                          <h4 id="dialog-sticky-title">Are you sure what you want to delete selected user(-s)?</h4>
                          <p id="dialog-sticky-description">This action cannot be undone.</p>
                      </div>

                      <footer class="margin-top-md">
                          <div class="flex justify-end gap-xs flex-wrap">
                              <button class="btn btn--subtle js-dialog__close">Cancel</button>
                              <button id="accept-delete" class="btn btn--accent">Delete</button>
                          </div>
                      </footer>

                      <input type="hidden" id="delete-users-list">
                  </div>
              </div>

          </div>
          <!-- END Control Bar-->

          <!-- Table -->
          <div class="margin-top-auto border-top border-contrast-lower border-opacity-30%"></div><!-- Divider -->
          <div class="padding-sm">
            <div id="table-1" class="int-table text-sm js-int-table">
              <div class="int-table__inner margin-bottom-xs">
                <table class="int-table__table" aria-label="Interactive table example">
                  <thead class="js-int-table__header">
                    <tr class="int-table__row">
                      <td class="int-table__cell">
                        <div class="custom-checkbox int-table__checkbox">
                          <input class="custom-checkbox__input js-int-table__select-all user-list-checkbox-all" type="checkbox" aria-label="Select all rows" />
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

                      <th class="int-table__cell int-table__cell--th text-left">Posts</th>
                      <th class="int-table__cell int-table__cell--th text-left">Comments</th>


                      <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort
                          @if(request()->get('sortBy') === 'role')
                              @if(request()->get('sortDesc') === 'desc')
                                  int-table__cell--desc
                              @endif
                              @if(request()->get('sortDesc') === 'asc')
                                  int-table__cell--asc
                              @endif
                          @endif
                          " data-sort-col="role">
                        <div class="flex items-center">
                          <span>Role</span>

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
                          " data-date-format="dd-mm-yyyy" data-sort-col="created_at">
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

                    <!-- Content Row -->
                    @foreach($users as $user)
                    <tr class="int-table__row">
                      <th class="int-table__cell" scope="row">
                        <div class="custom-checkbox int-table__checkbox">
                          <input class="custom-checkbox__input user-list-checkbox js-int-table__select-row" type="checkbox" data-user-id="{{$user->id}}" aria-label="Select this row" />
                          <div class="custom-checkbox__control" aria-hidden="true"></div>
                        </div>
                      </th>



                      <td class="int-table__cell flex bg-color-black">
                      <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
                        <a href="{{ route ('admin.users.edit', $user->id) }}"><img class="block width-100% height-100% object-cover" src="{{ asset('/assets'.$user->avatar)  }}" alt="Author picture"></a>
                      </figure>
                      <div class="line-height-xs padding-top-xxxs">
                        <p class=""><a href="{{ route ('admin.users.edit', $user->id) }}" class="link-subtle">{{ $user->name }}</a></p>
                        <p class="color-contrast-medium"><span class="text-sm">{{ $user->email }}</span></p>
                      </div>
                      </td>

                      <td class="int-table__cell">24</td>
                      <td class="int-table__cell">324</td>
                      <td class="int-table__cell">Editor</td>
                      <td class="int-table__cell">{{ $user->created_at->diffForHumans() }}</td>

                      <!-- Action Dropdown -->
                      <td class="int-table__cell">
                      <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example-{{$user->id}}">
                          <svg class="icon" viewBox="0 0 16 16">
                            <circle cx="8" cy="7.5" r="1.5" />
                            <circle cx="1.5" cy="7.5" r="1.5" />
                            <circle cx="14.5" cy="7.5" r="1.5" />
                          </svg>
                        </button>

                        <menu id="menu-example-{{$user->id}}" class="menu js-menu" target="_blank">
                        <li role="menuitem">
                          <span class="menu__content js-menu__content">
                            <a class="link-subtle" href="{{ route('admin.users.edit', $user->id) }}">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                              <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                            </svg>View
                          </a>
                          </span>
                        </li>

                        <li role="menuitem">
                          <span class="menu__content js-menu__content">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                              <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                            </svg>
                            <span>Suspend</span>
                          </span>
                        </li>

                        <li role="menuitem">
                          <span class="menu__content js-menu__content">
                            <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                              <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
                              <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
                            </svg>
                              <span class="delete-user-context-menu" data-user-id="{{ $user->id }}">Delete</span>
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
        @include('components.pagination', ['items' => $users])
          <!-- Pagination END-->
          <!-- Table END -->

        </div><!-- END Col-12 Card -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
        @include('admin.partials.sidebar')
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END -->
  </div>
</section

@endsection
