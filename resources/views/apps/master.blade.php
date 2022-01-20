<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <title>Traders</title>
</head>
<body data-theme="dark">
  @include('partials.header')
    @yield('content')
  @include('partials.footer')
<script src="{{ asset('assets/js/scripts.js') }}"></script>

@yield('scripts')
</body>
</html>
