@extends(config('theme.admin_app_template'))

@section('content')
    <div class="grid gap-md justify-between">
        <div class="col-12@md">
            {!! $page->getContent() !!}
        </div>
    </div>
@endsection