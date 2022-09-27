@extends(config('theme.admin_app_template'))

@section('content')
<div class="position-relative">
    <!-- Post Body -->
    <div class="post-content padding-md">
        <div class="flex justify-between items-center">
            <h1>{{ $contest->title }}</h1>
            <h4 class="flex gap-sm"><span>Hosted by:</span> <span class="flex items-center gap-xs">{!! $author_avatar !!} {{$author->name}}</span></h4>
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


