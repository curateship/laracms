@extends(config('theme.main_app_template'))
@section('content')

@push('custom-scripts')
    @include('components.posts.comments.scripts-js')
    @include('components.posts.likes.scripts-js')
@endpush

<div class="grid gap-md">
  <!-- Sticky Interactions Sidebar -->
  <div class="col-1@md display@md">
    @include('components.layouts.partials.sticky-interactions')
  </div>

  <!-- Content -->
  <div class="col-11@md padding-x-lg@md">
      @if($post->user_id == \Illuminate\Support\Facades\Auth::id() && $post->status == 'pending')

      <aside class="note note--warning margin-bottom-md">
          <div class="flex items-center">
            <svg class="icon icon--md margin-right-sm" viewBox="0 0 30 30">
              <path d="M12.4 2.563L.377 24.518A3.023 3.023 0 0 0 3.006 29h23.987a3.023 3.023 0 0 0 2.632-4.477L17.66 2.569a2.992 2.992 0 0 0-5.26-.006z" fill="var(--color-warning-dark)" opacity=".25"></path>
              <path fill="none" stroke="var(--color-warning-dark)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19v-9"></path>
              <circle cx="15" cy="23.5" r="1.5" fill="var(--color-warning-dark)"></circle>
            </svg>

            <p class="note__title  color-contrast-higher"><strong>Your post is in pending review</strong></p>
          </div>

          <div class="flex margin-top-xxxs">
            <!-- spacer - occupy same space of icon above 👆 -->
            <svg class="icon icon--md margin-right-sm" aria-hidden="true"></svg>

            <div class="note__content text-component">
              <!-- note content -->
              <p>To ensure quality on our site. All posts must be approved</p>
              <!-- end note content -->
            </div>
          </div>
        </aside>
        
      @endif

    @include('components.posts.show.types.image')

  <!-- Author Box -->
  <div class="padding-y-lg">
  @include('components.users.show.author-box')

  </div>
  <!-- Comments -->
  <div class="border-top margin-top-sm"></div>
    <section class="comments margin-top-md">
      @include('components.comments.list')
    </section>
  </div>

  <!-- Sidebar -->
  <div class="col-3@md">
    <h3 class="padding-bottom-sm color-contrast-high">Related Posts</h3>
      @include('components.posts.lists.filtered-posts.related-posts-sidebar')
  </div>
</div>
@endsection
