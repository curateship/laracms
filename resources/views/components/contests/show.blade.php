@extends(config('theme.admin_app_template'))

@push('custom-scripts')
    @include('components.contests.script-js')
@endpush

@section('content')
<div class="main-contests-container">
    <!-- Post Body -->
    <div class="post-content padding-md position-relative">
      <div class="flex justify-between items-center">
        <h1>{{ $contest->title }}</h1>
          <h4 class="flex gap-sm"><span>Hosted by:</span> <span class="flex items-center gap-xs desktop-user-avatar radius-50%">{!! $author_avatar !!} {{$author->name}}</span></h4>
      </div>

        <div class="flex gap-sm">
            <!-- Followers -->
            <div class="followers-container"></div>
            <!-- Join -->
            <fieldset style="display: {{\Illuminate\Support\Facades\Auth::guest() ? 'none' : 'block'}}">
                <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
                    <li>
                        <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input-{{$contest->id}}" data-contest-id="{{$contest->id}}">
                            <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$contest->id}}" {{$followed ? 'checked' : ''}} data-contest-id="{{$contest->id}}">
                            <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                            <span class="follow-label" data-contest-id="{{$contest->id}}">{{$followed ? 'Leave Contest' : 'Join Contest'}}</span>
                        </label>
                    </li>
                </ul>
            </fieldset>
        </div>

        <div class="post-content">
            <div class="margin-top-md">{!! $contest->getContent() !!}</div>
        </div>

        <div>
            @include(config('theme.content_grid'))
        </div>
    </div>

    <!-- Fade background -->
    <!--
    <div class="flex justify-center position-absolute margin-auto left-0 right-0 top-0">
        <figure class="width-100% card__img img-blend opacity-20%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="100%">
            <img class="radius-md post-image" src="{{url('/storage').config('images.contests_storage_path').$contest->medium}}" alt="contest-background">
        </figure>
    </div>
    -->
</div>

    <style>
        .main-contests-container::before {
            content: "";
            background-image: url('{{url('/storage').config('images.contests_storage_path').$contest->medium}}');
            background-size: cover;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.15;
        }
    </style>
@endsection


