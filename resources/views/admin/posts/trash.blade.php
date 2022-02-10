@extends('admin.apps.master')
@section('content')
  
<!-- 👇 Content Body Wrapper-->
<section class="margin-y-md">
@include('admin.partials.modal')
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

      <!-- Content Table Column -->
<div class="card">
  <div class="int-table-actions" data-table-controls="table-1">

    <!-- Control Bar -->
    <div class="controlbar--sticky flex justify-between">
      <div class="margin-sm">
        <div class="inline-flex items-baseline">

          <!-- Bread Crumb -->
          <nav class="breadcrumbs text-sm padding-left-xs" aria-label="Breadcrumbs">
            <ol class="flex flex-wrap gap-xxs">
              <li class="breadcrumbs__item">
                <a href="/admin" class="color-inherit link-subtle">Home</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>

              <li class="breadcrumbs__item">
                <a href="/admin/post" class="color-inherit link-subtle">Post</a>
                <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
              </li>

              <li class="breadcrumbs__item color-primary" aria-current="page">Trash</li>
              <button class="margin-left-sm btn btn--sm btn--accent">Clear all trash</button>
            </ol>
          </nav>
          <!-- Bread Crumb END -->

        </div>
      </div>
      <!-- END Control Bar-->
      @include('admin.post.partials.control')
  </div><!-- END card -->
<!-- END Control Bar-->

<!-- Table-->
<div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
<div class="padding-sm">
  <div id="table-1" class="int-table text-sm js-int-table">
    <div class="int-table__inner margin-bottom-xs">
      <table class="int-table__table" aria-label="Interactive table example">
        <thead class="js-int-table__header">
          <tr class="int-table__row">
            <td class="int-table__cell">
              <div class="custom-checkbox int-table__checkbox">
                <input class="custom-checkbox__input js-int-table__select-all" type="checkbox" aria-label="Select all rows" />
                <div class="custom-checkbox__control" aria-hidden="true"></div>
              </div>
            </td>
  
            <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
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
  
            <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
              <div class="flex items-center">
                <span>Status</span>
  
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
  
            <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort" data-date-format="dd-mm-yyyy">
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
  
            <th class="int-table__cell int-table__cell--th text-left">Preview</th>
            <th class="int-table__cell int-table__cell--th text-right">Action</th>
          </tr>
        </thead>
  
        <tbody class="int-table__body js-int-table__body">
  
          <tr class="int-table__row">
            <th class="int-table__cell" scope="row">
              <div class="custom-checkbox int-table__checkbox">
                <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" />
                <div class="custom-checkbox__control" aria-hidden="true"></div>
              </div>
            </th>
            <td class="int-table__cell flex">
            <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
              <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
            </figure>
            <div class="line-height-xs">
              <div class="margin-bottom-xxxxs"><a href="#0" class="link-subtle" aria-controls="edit-modal">Content Title Content Title Content Title</a></div>
              <p class="color-contrast-medium"><a href="#0" class="text-sm link-subtle">james4523</a></p>       
            </td>

            <td class="int-table__cell">Published</td>
            <td class="int-table__cell">01/01/2020</td>
            <td class="int-table__cell"><button class="btn btn--primary" aria-controls="preview-modal">Preview</button></td>
            <td class="int-table__cell">
              <button class="reset int-table__menu-btn margin-left-auto">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16" aria-controls="dialog">
                  <g>
                    <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                    <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                  </g>
               </svg>
              </button>
            </td>
          </tr>

          <tr class="int-table__row">
            <th class="int-table__cell" scope="row">
              <div class="custom-checkbox int-table__checkbox">
                <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" />
                <div class="custom-checkbox__control" aria-hidden="true"></div>
              </div>
            </th>
            <td class="int-table__cell flex">
            <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
              <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
            </figure>
            <div class="line-height-xs">
              <p class="margin-bottom-xxxxs"><a href="#0" class="link-subtle" aria-controls="edit-modal">Content Title Content Title Content Title</a></p>
              <p class="color-contrast-medium"><a href="#0" class="text-sm link-subtle">james4523</a></p>     
            </td>

            <td class="int-table__cell">Published</td>
            <td class="int-table__cell">01/01/2020</td>
            <td class="int-table__cell"><button class="btn btn--primary" aria-controls="preview-modal">Preview</button></td>
            <td class="int-table__cell">
              <button class="reset int-table__menu-btn margin-left-auto">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16" aria-controls="dialog">
                  <g>
                    <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                    <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                  </g>
               </svg>
              </button>
            </td>
          </tr>

          <tr class="int-table__row">
            <th class="int-table__cell" scope="row">
              <div class="custom-checkbox int-table__checkbox">
                <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" />
                <div class="custom-checkbox__control" aria-hidden="true"></div>
              </div>
            </th>
            <td class="int-table__cell flex">
            <figure class="width-lg height-lg radius-50% flex-shrink-0 overflow-hidden margin-right-xs">
              <img class="block width-100% height-100% object-cover" src="/assets/img/table-v2-img-1.jpg" alt="Author picture">
            </figure>
            <div class="line-height-xs">
              <p class="margin-bottom-xxxxs"><a href="#0" class="link-subtle" aria-controls="edit-modal">Content Title Content Title Content Title</a></p>
              <p class="color-contrast-medium"><a href="#0" class="text-sm link-subtle">james4523</a></p>     
            </td>

            <td class="int-table__cell">Published</td>
            <td class="int-table__cell">01/01/2020</td>
            <td class="int-table__cell"><button class="btn btn--primary" aria-controls="preview-modal">Preview</button></td>
            <td class="int-table__cell">
              <button class="reset int-table__menu-btn margin-left-auto">
                <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16" aria-controls="dialog">
                  <g>
                    <path d="M2,6v8c0,1.1,0.9,2,2,2h8c1.1,0,2-0.9,2-2V6H2z"></path>
                    <path d="M12,3V1c0-0.6-0.4-1-1-1H5C4.4,0,4,0.4,4,1v2H0v2h16V3H12z M10,3H6V2h4V3z"></path>
                  </g>
               </svg>
              </button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- END Table-->

<!-- Pagination Start-->
    <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
    <nav class="pagination" aria-label="Pagination">
      <ol class="pagination__list flex flex-wrap gap-xxxs justify-center padding-xs">
        <li>
          <a href="#0" class="pagination__item pagination__item--disabled" aria-label="Go to previous page">
            <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            <span>Prev</span>
          </a>
        </li>
  
        <li class="display@sm">
          <a href="#0" class="pagination__item" aria-label="Go to page 1">1</a>
        </li>
  
        <li class="display@sm">
          <a href="#0" class="pagination__item" aria-label="Go to page 2">2</a>
        </li>
  
        <li class="display@sm">
          <a href="#0" class="pagination__item pagination__item--selected" aria-label="Current Page, page 3" aria-current="page">3</a>
        </li>
  
        <li class="display@sm">
          <a href="#0" class="pagination__item" aria-label="Go to page 4">4</a>
        </li>
  
        <li class="display@sm" aria-hidden="true">
          <span class="pagination__item pagination__item--ellipsis">...</span>
        </li>
  
        <li class="display@sm">
          <a href="#0" class="pagination__item" aria-label="Go to page 20">20</a>
        </li>
  
        <li>
          <a href="#0" class="pagination__item" aria-label="Go to next page">
            <span>Next</span>
            <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
          </a>
        </li>
      </ol>
    </nav>
<!-- Pagination END-->

  </div>
</div>
<!-- END Content Body Wrapper -->


      </div>
      <div class="col-3@md">@include('admin.partials.sidebar')</div>
    </div>
  </div>
</section
@endsection