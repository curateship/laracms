@extends(config('theme.main_app_template'))
@section('content')

<!-- Container -->

<div class="text-component padding-bottom-md">
    <h1 class="text-xl">{{$fav_name}}</h1>
</div>

<!-- List Component -->
<div class="padding-bottom-md">
    @include('components.lists.show')
</div>

<!-- Pagination -->
<div class="padding-bottom-md">
</div>

@endsection
