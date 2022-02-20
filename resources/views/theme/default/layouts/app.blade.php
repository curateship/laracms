<!doctype html>
<html lang="en" class="js">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/svg+xml" href="{{ !empty($settings_data['favicon']) ? asset($settings_data['favicon']) : asset('assets/img/favicon.svg') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <title>{{ config ('app.name', 'LaraCMS') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Roboto+Slab&display=swap" rel="stylesheet">


  <!-- 👇 Back to Top -->
  <a class="back-to-top js-back-to-top" href="#" data-offset="100" data-duration="300">
    <svg class="icon" viewBox="0 0 20 20"><polyline points="2 13 10 5 18 13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
  </a>
  <!-- Back to Top END -->
</head>

<body data-theme="@guest(){{config('app.default_theme')}}@else{{auth()->user()->theme()}}@endguest">
  @include('theme.default.partials.header')
  <div class="padding-top-sm">
    @yield('content')
  </div>
  @include('theme.default.partials.footer')
<script src="{{ asset('assets/js/scripts.js') }}"></script>
  @stack('custom-scripts')

<!-- Script to fix Modal overlap -->
@if($errors->has('email') || $errors->has('password'))
  <script>
      // Create the event;
      let event = new Event('openModal');

      // Dispatch it to exist CodyHouse modal;
      @if(old('target') != '')
      document.getElementById('{{old('target')}}').dispatchEvent(event);
          @else
          document.getElementById('modal-forgot-password').dispatchEvent(event);
          @endif

  </script>
@endif

@yield('scripts')
</body>

</html>
