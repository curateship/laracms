<!doctype html>
<html lang="en" class="js">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/svg+xml" href="{{ asset(env('FAV_ICON_URL')) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  {!! SEOMeta::generate() !!}
  {!! env('FONT') !!}
  @include('components.layouts.partials.back-to-top')<!-- Back to Top -->
</head>

<!-- Theme config -->
<body data-theme="@guest(){{config('app.default_theme')}}@else{{auth()->user()->theme()}}@endguest">

<!-- Header -->
  @include(config('theme.header'))

<!-- Random Image -->
<div class="position-relative">
    @if(strpos(request()->getPathInfo(), '/user/') === false || request()->getPathInfo() === '/user/edit')
        @include('components.layouts.partials.hero-random-image')
    @else
      <div class="">
        <figure class="card__img img-blend opacity-50%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg" data-blend-height="30%" style="background-color: var(--color-bg);">
          @if($user->cover_medium != '')
            <img class="radius-md object-cover height-550 height-md@sm" src="{{url('/storage'.config('images.users_storage_path').$user->cover_medium)}}" alt="Card preview img">
            @else
              <div style="height: 140px;"></div>
          @endif
        </figure>
      </div>
    @endif
</div>

<!-- Content -->
<div class="container max-width-adaptive-lg">
  @yield('content')
</div>

<!-- Footer -->
<div class="padding-top-sm">
  @include(config('theme.footer'))
</div>

<!-- Tracker -->
<div class="padding-top-sm">
  @include(config('theme.tracker'))
</div>

<!-- Scripts -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
  @stack('custom-scripts')
</body>
</html>
