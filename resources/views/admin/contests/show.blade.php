@extends(config('theme.admin_app_template'))

@section('content')
<div class="position-relative">
    <!-- Post Body -->
    <div class="post-content padding-md">
      <div class="flex justify-between items-center">
        <h1>{{ $contest->title }}</h1>
          <h4 class="flex gap-sm"><span>Hosted by:</span> <span class="flex items-center gap-xs desktop-user-avatar radius-50%">{!! $author_avatar !!} {{$author->name}}</span></h4>
      </div>

    <!-- Avatar group -->
    <div class="avatar-group">
      <div class="avatar">
        <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
          <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
          <img class="avatar__img" src="https://codyhouse.co/app/assets/img/avatar-img-1.svg" alt="Emily Ewing" title="Emily Ewing">
        </figure>
      </div>

      <div class="avatar">
        <figure class="avatar__figure" role="img" aria-label="James Powell">
          <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
          <img class="avatar__img" src="https://codyhouse.co/app/assets/img/avatar-img-2.svg" alt="James Powell" title="James Powell">
        </figure>
      </div>

      <div class="avatar">
        <figure class="avatar__figure" role="img" aria-label="Olivia Gribben">
          <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
          <img class="avatar__img" src="https://codyhouse.co/app/assets/img/avatar-img-3.svg" alt="Olivia Gribben" title="Olivia Gribben">
        </figure>
      </div>

      <button class="avatar avatar--btn" aria-label="show all users">
        <figure aria-hidden="true" class="avatar__figure">
          <div class="avatar__users-counter"><span>+12</span></div>
        </figure>
      </button>

        <!-- Join -->
        <fieldset>
        <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
          <li>
            <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag" for="checkbox-tag-phone-call">
              <input class="sr-only" type="checkbox" id="checkbox-tag-phone-call" checked>
        
              <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
        
              <span>Join Contest</span>
            </label>
          </li>
        </ul>
        </fieldset>
      </div> 

        <div class="post-content">
            <div class="margin-top-md">{!! $contest->getContent() !!}</div>
        </div>
    </div>

    <!-- Fade background -->
    <div class="position-absolute flex justify-center margin-auto left-0 right-0 top-0">
        <!-- Post Image With Gradiant -->
        <figure class="width-100% card__img img-blend opacity-20%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="100%">
            <img class="radius-md post-image" src="{{url('/storage').config('images.contests_storage_path').$contest->medium}}" alt="contest-background">
        </figure>
    </div>
</div>
@endsection


