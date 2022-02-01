<nav class="pagination text-sm" aria-label="Pagination">
  <ol class="pagination__list flex flex-wrap gap-xs justify-center padding-sm">
    <li>
      <a href="{{ $users->url($users->currentPage()-1) }}" class="pagination__item {{ ($users->currentPage() == 1) ? ' pagination__item--disabled' : '' }}" aria-label="Go to previous page">
        <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
        <span>Prev</span>
      </a>
    </li>

      @for ($i = 1; $i <= $users->lastPage(); $i++)
          <li class="display@sm">
              <a href="{{ $users->url($i) }}" class="pagination__item {{ ($users->currentPage() == $i) ? ' pagination__item--selected' : '' }}" aria-label="Go to page {{ $i }}">{{ $i }}</a>
          </li>
      @endfor

    <li>
      <a href="{{ $users->url($users->currentPage()+1) }}" class="pagination__item {{ ($users->currentPage() == $users->lastPage()) ? ' pagination__item--disabled' : '' }}" aria-label="Go to next page">
        <span>Next</span>
        <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
      </a>
    </li>
  </ol>
</nav>
