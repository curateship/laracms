@extends(env('MAIN_APP_TEMPLATE'))

@section('content')
    <div class="grid gap-md justify-between">
        <div class="col-12@md">
            {!! $page->getContent() !!}
        </div>
    </div>
@endsection
