@extends(config('theme.main_app_template'))
@section('content')
    <div class="padding-md">
        <div class="margin-bottom-lg">
            <ul class="grid-auto-xs grid-auto-sm@sm grid-auto-lg@md gap-md">
                @foreach($contests as $contest)
                    <li class="card">
                        <a href="/contest/{{$contest->slug}}">
                            <figure class="aspect-ratio-4:3 margin-bottom-xs">
                                <img class="block width-100% radius-md radius-bottom-right-0 radius-bottom-left-0" loading="lazy" src="{{ url('/storage').config('images.contests_storage_path').$contest->thumbnail  }}" alt="Image description">
                            </figure>
                        </a>
                        <div class="card__content recent-post-card line-height-1 margin-xxs">
                            <a href="/contest/{{$contest->slug}}" class="link-subtle text-sm">{{$contest->title}}</a>
                            <p class="text-xs color-contrast-low padding-top-sm">{{ $contest->created_at->diffforhumans() }}<br></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
