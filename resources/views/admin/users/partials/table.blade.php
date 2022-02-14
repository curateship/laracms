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
              <a href="{{ route ('admin.users.edit', $user->id) }}"><img class="block width-100% height-100% object-cover" src="{{ $user->image ? asset('storage/' . $user->image->path. '') : 'https://images.assetsdelivery.com/compings_v2/salamatik/salamatik1801/salamatik180100019.jpg'  }}" alt="Author picture"></a>
            </figure>
            <div class="line-height-xs padding-top-xxxs">
              <p class=""><a href="{{ route ('admin.users.edit', $user->id) }}" class="link-subtle">{{ $user->name }}</a></p>
              <p class="color-contrast-medium"><span class="text-sm">{{ $user->email }}</span></p>
            </div>
            </td>

            <td class="int-table__cell">24</td>
            <td class="int-table__cell">324</td>
            <td class="int-table__cell">Editor</td>
            <td class="int-table__cell">{{date('d/m/Y', strtotime($user->created_at))}}</td>

            <!-- Action Dropdown -->
            <td class="int-table__cell">
            <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example-{{$user->id}}">
                <svg class="icon" viewBox="0 0 16 16">
                  <circle cx="8" cy="7.5" r="1.5" />
                  <circle cx="1.5" cy="7.5" r="1.5" />
                  <circle cx="14.5" cy="7.5" r="1.5" />
                </svg>
              </button>

              <menu id="menu-example-{{$user->id}}" class="menu js-menu">
              <li role="menuitem">
                <span class="menu__content js-menu__content">
                  <a class="link-subtle" href="{{ route('admin.users.edit', $user->id) }}">
                  <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                    <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                  </svg>Edit
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
