<footer class="footer-v4 padding-y-lg">
  <div class="container max-width-lg">

    <!-- Footer Navigation -->
    <nav class="footer-v4__nav">
      <ul class="footer-v4__nav-list">
      {!! Menu::get('footer')->asUl() !!}
      </ul>
    </nav>

    <!-- LOGO -->
    <div class="footer-v4__logo">
      {!! env('LOGO') !!}
    </div>

    <p class="footer-v4__print">&copy; Copyright. All rights reserved.</p>

  </div>
</footer>

