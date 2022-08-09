@extends(config('theme.main_app_template'))
@section('content')

<div class="grid gap-md">

  <h1>Interactive</h1>
    @include('components.tags.lists.related-posts')

</div>
@endsection
