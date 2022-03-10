<footer class="footer-v4 padding-y-lg">
  <div class="container max-width-lg">
    <nav class="footer-v4__nav">
      <ul class="footer-v4__nav-list">
          {!! Menu::get('footer')->asUl() !!}
      </ul>
    </nav>
      @include('components.layouts.svg.logo-social-footer')
  </div>
</footer>
