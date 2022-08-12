@extends(config('theme.main_app_template'))
@section('content')

<div class="grid gap-md">

  <!-- User Informations -->
  <div class="col-4@md margin-bottom-md">
    <div class="card margin-bottom-sm">
      @include('components.users.show.user-bio-card')
    </div>

      <!-- Following -->
      <div class="card margin-top-md">
          <div class="flex justify-between items-baseline padding-sm padding-bottom-sm">
              <h1 class="text-base color-contrast-medium">Following ({{count($following)}})</h1>
              <a class="text-sm link-plain" href="#0">View all</a>
          </div>
          <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
          @include('components.users.lists.my-followers-with-button', ['follow_list' => $following])
      </div>

    <!-- Followers -->
      <div class="card margin-top-md">
          <div class="flex justify-between items-baseline padding-sm">
            <h1 class="text-base color-contrast-medium">Followers ({{count($followers)}})</h1>
            <a class="text-sm link-plain" href="#0">View all</a>
          </div>
          <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
            @include('components.users.lists.my-followers-with-button', ['follow_list' => $followers])
      </div>
  </div>

  <!-- Users Posts -->
  <div class="col-11@md">
    <div class="justify-between flex items-end justify-between@md margin-bottom-md">
      <div class="justify-between flex items-end justify-between@md">
        <a href="/user/{{$user->username}}" class="btn {{request()->get('type') === null ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs" role="text">{{$user->name}}'s Posts</a>
        <a href="/user/{{$user->username}}?type=liked" class="btn {{request()->get('type') === 'liked' ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs" role="text">Likes</a>
        <a href="/user/{{$user->username}}?type=favorite" class="btn {{request()->get('type') === 'favorite' ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full" role="text">My Lists</a>
      </div>
    </div>
    @include('components.users.lists.user-posts')

    <!-- Pagination -->
    <div class="margin-top-md">
      @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>
  </div>
</div>

@endsection
