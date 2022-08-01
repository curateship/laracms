<footer class="padding-y-lg align-middle">
  <div class="container max-width-lg">

    <!-- Footer Navigation -->
    <div class="flex justify-center padding-sm">
      {!! Menu::get('footer')->asUl() !!}
    </div>

    <!-- Logo and Social -->
    <div class="flex justify-center padding-top-md">
      {!! env('LOGO') !!}
    </div>

  </div>
</footer>
