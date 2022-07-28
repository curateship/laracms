@extends('theme.layouts.app')
@section('content')

<div class="padding-md padding-lg@md">

    <!-- Recent Posts -->
    <div class="margin-bottom-lg">
      @include('components.posts.lists.recent-posts.recent-posts-grid-hr')
    </div>

    <!-- Pagination -->
    <div class="padding-bottom-md">
        @include('components.layouts.partials.pagination', ['items' => $recent_posts])
    </div>

    <div class="container max-width-md text-component margin-top-lg">
      <h2 class="padding-bottom-sm color-contrast-medium">The Best Hentai Exprience. We prioritize quality!</h2>
      <p class="color-contrast-low">In this variation, the extra content is wrapped in the .js-read-more__content element. You can decide the exact point where the text is truncated.</p>
      <p class="color-contrast-low read-more js-read-more" data-btn-class="read-more__btn js-tab-focus" data-ellipsis="off">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio corporis facilis, debitis a qui eum dolor repudiandae harum, impedit, fugit cumque. Tenetur, a quas labore eveniet accusantium, vero reiciendis quaerat inventore vel consequatur iusto fugiat perferendis rerum nihil qui deleniti earum eum numquam velit quod explicabo, fuga saepe ad temporibus! <span class="js-read-more__content">Facere et voluptas sint similique, sequi corporis consectetur id suscipit est placeat ut expedita temporibus quisquam at illo dolores, laudantium assumenda! Ut tempora qui repellat quibusdam odit beatae commodi unde iure sunt provident voluptate ipsam veniam culpa harum ducimus assumenda voluptas omnis, consequuntur quam id in quos rem, excepturi iusto!</span>
      </p>
    </div>

</div>
@endsection