<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Get Started | CodyFrame</title>
</head>
<body>
  @include('partials.header')

  <div class="container max-width-sm padding-y-lg ">
    @yield('content')
  </div>

<script src="assets/js/scripts.js"></script>
</body>
</html>
