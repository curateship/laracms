<!doctype html>
<html lang="en" class="js">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/svg+xml" href="{{ !empty($settings_data['favicon']) ? asset($settings_data['favicon']) : asset('assets/img/favicon.svg') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  {!! SEOMeta::generate() !!}
  @include('components.layouts.partials.fonts')
  @include('components.layouts.partials.back-to-top')<!-- Back to Top -->
</head>

<!-- Theme config -->
<body data-theme="@guest(){{config('app.default_theme')}}@else{{auth()->user()->theme()}}@endguest">

<!-- Header -->
@include('components.layouts.headers.header-hr')

<div class="">
  @yield('content')
</div>

<!-- Footer -->
<div class="padding-top-sm">
  @include('components.layouts.footers.footer-hr')
</div>

<!-- Tracker -->
<div class="padding-top-sm">
  @include('components.layouts.partials.tracker')
</div>

<!-- Scripts -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
  @stack('custom-scripts')
</body>
</html>
