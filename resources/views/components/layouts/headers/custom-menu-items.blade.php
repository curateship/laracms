@foreach($items as $item)
    <li class="header-v2__nav-item @if(!isset($child_mode)) header-v2__nav-item--main @endif @if($item->hasChildren()) header-v2__nav-item--has-children @endif" >
        <a class="header-v2__nav-link" href="{!! $item->url() !!}">
            <span>
                @if(!isset($child_mode))
                    {!! $item->title !!}
                @else
                    <strong>{!! $item->title !!}</strong>
                @endif
            </span>
            @if($item->hasChildren())
                <svg class="header-v2__nav-dropdown-icon icon margin-left-xxxs" aria-hidden="true" viewBox="0 0 16 16">
                    <polyline fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="3.5,6.5 8,11 12.5,6.5 "></polyline>
                </svg>
            @endif
        </a>
        @if(count($item->children()) > 0)
            <div class="header-v2__nav-dropdown header-v2__nav-dropdown--md">
            @if($item->hasChildren())
                <ul class="header-v2__nav-list header-v2__nav-list--title-desc">
                @include('components.layouts.headers.custom-menu-items', ['items' => $item->children(), 'child_mode' => true])
                </ul>
            @endif
            </div>
        @endif
    </li>
@endforeach
