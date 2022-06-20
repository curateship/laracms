<div class="explorer__results flex-grow js-autocomplete__results">
    <ul id="favorite-list" class="explorer__list js-autocomplete__list" role="list">
        <li class="js-autocomplete__item js-explorer__command add-new-favorite-button" data-autocomplete-template="button" tabindex="-1">
            <button class="reset explorer__result">
                <!-- icon -->
                <span class="explorer__icon margin-right-xxs" aria-hidden="true" data-autocomplete-icon="" data-autocomplete-html=""><svg class="icon" viewBox="0 0 20 20"><g stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M10,19H4a3,3,0,0,1-3-3V1H8l2,4h9v5"></path><line x1="15" y1="11" x2="15" y2="19"></line><line x1="11" y1="15" x2="19" y2="15"></line></g></svg></span>

                <!-- label -->
                <i class="text-truncate padding-right-xs" data-autocomplete-label="">New list</i>

                <!-- shortcut -->
                <span class="flex-shrink-0 margin-left-auto" data-autocomplete-shortcut="" data-autocomplete-html=""></span>
            </button>
        </li>

        @foreach($list as $item)
            <li class="js-autocomplete__item js-explorer__command {{$item->in_list ? ' list-item-inlist' : ''}}" data-autocomplete-template="button" tabindex="-1" style="display: flex;align-items: center;">
                <button class="reset explorer__result select-template-for-add" data-list-id="{{$item->id}}">
                    <!-- icon -->
                    <span class="explorer__icon margin-right-xxs" aria-hidden="true" data-autocomplete-icon="" data-autocomplete-html="">
                        <img class="user-cell__img margin-right-xs" style="max-height: 35px; max-width: 35px; border-radius: 50%;" alt="list-logo" src="{{$item->thumbnail}}">
                    </span>

                    <!-- label -->
                    <i class="text-truncate padding-right-xs" data-autocomplete-label="">{{$item->name}}</i>

                    <!-- shortcut -->
                    <span class="flex-shrink-0" data-autocomplete-shortcut="" data-autocomplete-html=""><i class="explorer__shortcut">{{$item->posts_count}}</i></span>
                </button>
                <span class="flex-shrink-0 margin-left-auto remove-fav-list btn btn--sm btn--accent margin-right-sm" data-list-id="{{$item->id}}">Delete</span>
            </li>
        @endforeach
    </ul>
</div>
