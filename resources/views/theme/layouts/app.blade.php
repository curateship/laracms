<!doctype html>
<html lang="en" class="js">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/svg+xml" href="{{ !empty($settings_data['favicon']) ? asset($settings_data['favicon']) : asset('assets/img/favicon.svg') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  {!! SEOMeta::generate() !!}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Roboto+Slab&display=swap" rel="stylesheet">

  <!-- Back to Top -->
  <a class="back-to-top js-back-to-top" href="#" data-offset="100" data-duration="300">
    <svg class="icon" viewBox="0 0 20 20"><polyline points="2 13 10 5 18 13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
  </a>
</head>

<!-- Theme config -->
<body data-theme="@guest(){{config('app.default_theme')}}@else{{auth()->user()->theme()}}@endguest">

<!-- Header -->
@include('components.layouts.headers.header')
@include('components.layouts.partials.hero-random-image')

<div class="padding-top-xs">
  @yield('content')
</div>

<!-- Footer -->
<div class="padding-top-sm">
  @include('components.layouts.footers.footer')
</div>

<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//artistion.com/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>

<!-- Scripts -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
  @stack('custom-scripts')
</body>
</html>
