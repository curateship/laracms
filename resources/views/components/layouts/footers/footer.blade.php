<footer class="padding-y-lg">
  <div class="container max-width-lg">

    <!-- Footer Navigation -->
    <div class="flex justify-center padding-sm">
      {!! Menu::get('footer')->asUl() !!}
    </div>

    <!-- Logo and Social -->
    <div class="text-center">
      @include('components.layouts.svg.logo-social-footer')
    </div>

  </div>
</footer>
