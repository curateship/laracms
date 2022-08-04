@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<div class="grid gap-md">

  <!-- Tag Category -->
  <h1>{{$category->name}}</h1>
    @if(count($tags) > 0)
        @include('components.tags.lists.tag-categories', ['tags' => $tags])
    @else
        No tags
    @endif

  <!-- Pagination -->
  <div class="padding-top-md">
    @include('components.layouts.partials.pagination', ['items' => $tags])
  </div>  

</div>
@endsection
