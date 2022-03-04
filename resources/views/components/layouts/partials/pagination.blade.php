<div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
<nav class="pagination text-sm" aria-label="Pagination">
    <ol class="pagination__list flex flex-wrap gap-xs justify-center padding-sm">
        <li>
            <a href="{{ $items->url($items->currentPage()-1) }}" class="pagination__item {{ ($items->currentPage() == 1) ? ' pagination__item--disabled' : '' }}" aria-label="Go to previous page">
                <svg class="icon icon--xs margin-right-xxxs flip-x" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                <span>Prev</span>
            </a>
        </li>

        @if($items->currentPage() > 3)
            <li class="display@sm">
                <a href="{{ $items->url(1) }}" class="pagination__item {{ ($items->currentPage() == 1) ? ' pagination__item--selected' : '' }}" aria-label="Go to page 1">1</a>
            </li>
        @endif
        @if($items->currentPage() > 4)
            <li class="display@sm" aria-hidden="true">
                <span class="pagination__item pagination__item--ellipsis">...</span>
            </li>
        @endif
        @foreach(range(1, $items->lastPage()) as $i)
            @if($i >= $items->currentPage() - 2 && $i <= $items->currentPage() + 2)
                <li class="display@sm">
                    <a href="{{ $items->url($i) }}" class="pagination__item {{ ($items->currentPage() == $i) ? ' pagination__item--selected' : '' }}" aria-label="Go to page {{ $i }}">{{ $i }}</a>
                </li>
            @endif
        @endforeach
        @if($items->currentPage() < $items->lastPage() - 3)
            <li class="display@sm" aria-hidden="true">
                <span class="pagination__item pagination__item--ellipsis">...</span>
            </li>
        @endif
        @if($items->currentPage() < $items->lastPage() - 2)
            <li class="display@sm">
                <a href="{{ $items->url($items->lastPage()) }}" class="pagination__item {{ ($items->currentPage() == $items->lastPage()) ? ' pagination__item--selected' : '' }}" aria-label="Go to page {{ $items->lastPage() }}">{{ $items->lastPage() }}</a>
            </li>
        @endif

        <li>
            <a href="{{ $items->url($items->currentPage()+1) }}" class="pagination__item {{ ($items->currentPage() == $items->lastPage()) ? ' pagination__item--disabled' : '' }}" aria-label="Go to next page">
                <span>Next</span>
                <svg class="icon icon--xs margin-left-xxxs" viewBox="0 0 16 16"><polyline points="6 2 12 8 6 14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            </a>
        </li>
    </ol>
</nav>
