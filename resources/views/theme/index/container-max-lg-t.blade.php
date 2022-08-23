@extends(config('theme.main_app_template'))
@section('content')

    <!-- Diagonal Hero -->
      <div class="margin-bottom-xs">
        {!! env('DIAGONAL_HERO') !!}
      </div>

    <!-- if guest
    @if (Auth::guest())
      <div class="margin-bottom-xs">
        {!! env('DIAGONAL_HERO') !!}
      </div>
    @endif
    -->

    <!-- Recent Posts -->
    <div class="margin-bottom-xl">
      @include(config('theme.content_grid'))
    </div>

    <!-- Site Discription -->
    <div class="">
        {!! env('SITE_DISCRIPTION') !!}
    </div>

@endsection
