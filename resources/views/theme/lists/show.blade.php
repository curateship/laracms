@extends('theme.layouts.app')
@section('content')

<!-- Container -->
<div class="container max-width-adaptive-lg padding-top-sm">

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

</div>
@endsection
