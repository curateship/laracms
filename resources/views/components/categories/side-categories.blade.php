@props(['categories'])

<div class="sidenav__label margin-bottom-xxxs">
    <span class="text-sm color-contrast-medium text-xs@md">Categories</span>
  </div>
  
  <ul class="sidenav__list">
      @foreach($categories as $category)
    <li class="sidenav__item">
      <a href="{{ route('theme.default.archive.categories.show', $category) }}" class="sidenav__link">
        <span class="sidenav__text text-sm@md">{{ $category->name }}</span>
        <span class="sidenav__counter">{{ $category->posts_count }}<i class="sr-only">notifications</i></span>
      </a>
    </li>
      @endforeach
  </ul>