@extends('theme.layouts.app')
@section('content')

<!-- 👇 Content Body Wrapper-->
<div class="container max-width-adaptive-lg">

    <!-- Tag Title -->
    <div class="text-component">
        <h1 class="text-xl">{{ $tag->name }}</h1>
    </div>

    <!-- Tag body -->
    <div class="text-component padding-bottom-md">
        {!! $tag->body() !!}
    </div>

    <!-- Post list -->
    <section class="margin-bottom-lg">
      @include('components.tags.lists.show')
    </section>
 
    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>

</div><!-- Container Wrapper END -->
@endsection
