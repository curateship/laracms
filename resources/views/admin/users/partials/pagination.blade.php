<nav class="pagination text-sm" aria-label="Pagination">
  <ol class="pagination__list flex flex-wrap gap-xs justify-center padding-sm">
    <li>
      <a href="{{ $users->url($users->currentPage()-1) }}" class="pagination__item {{ ($users->currentPage() == 1) ? ' pagination__item--disabled' : '' }}" aria-label="Go to previous page">
        <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
        <span>Prev</span>
      </a>
    </li>

      @if($users->currentPage() > 3)
          <li class="display@sm">
              <a href="{{ $users->url(1) }}" class="pagination__item {{ ($users->currentPage() == 1) ? ' pagination__item--selected' : '' }}" aria-label="Go to page 1">1</a>
          </li>
      @endif
      @if($users->currentPage() > 4)
          <li class="display@sm" aria-hidden="true">
              <span class="pagination__item pagination__item--ellipsis">...</span>
          </li>
      @endif
      @foreach(range(1, $users->lastPage()) as $i)
          @if($i >= $users->currentPage() - 2 && $i <= $users->currentPage() + 2)
              <li class="display@sm">
                  <a href="{{ $users->url($i) }}" class="pagination__item {{ ($users->currentPage() == $i) ? ' pagination__item--selected' : '' }}" aria-label="Go to page {{ $i }}">{{ $i }}</a>
              </li>
          @endif
      @endforeach
      @if($users->currentPage() < $users->lastPage() - 3)
          <li class="display@sm" aria-hidden="true">
              <span class="pagination__item pagination__item--ellipsis">...</span>
          </li>
      @endif
      @if($users->currentPage() < $users->lastPage() - 2)
          <li class="display@sm">
              <a href="{{ $users->url($users->lastPage()) }}" class="pagination__item {{ ($users->currentPage() == $users->lastPage()) ? ' pagination__item--selected' : '' }}" aria-label="Go to page {{ $users->lastPage() }}">{{ $users->lastPage() }}</a>
          </li>
      @endif

    <li>
      <a href="{{ $users->url($users->currentPage()+1) }}" class="pagination__item {{ ($users->currentPage() == $users->lastPage()) ? ' pagination__item--disabled' : '' }}" aria-label="Go to next page">
        <span>Next</span>
        <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
      </a>
    </li>
  </ol>
</nav>
