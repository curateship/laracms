@extends(config('theme.main_app_template'))
@section('content')

<div class="grid gap-md">

  <!-- User Informations -->
  <div class="margin-bottom-md">
    <div class="margin-bottom-sm">
      @include('components.users.show.user-bio')
    </div>

  <!-- Users Posts -->
    <div class="justify-between flex items-end justify-between@md margin-bottom-md">
      <div class="justify-between flex items-end justify-between@md">
        <a href="/user/{{$user->username}}" class="btn {{request()->get('type') === null ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs" role="text">{{$user->name}}'s Posts</a>
        <a href="/user/{{$user->username}}?type=liked" class="btn {{request()->get('type') === 'liked' ? 'btn--primary' : 'btn--subtle'}} btn--sm radius-full margin-right-xs" role="text">Likes</a>
        <a href="#" class="btn btn--subtle btn--sm radius-full" role="text">Comments</a>
      </div>
    </div>
    @include('components.users.lists.user-posts')
    
    <!-- Pagination -->
    <div class="margin-top-md">
      @include('components.layouts.partials.pagination', ['items' => $posts])
    </div>
  </div>

@endsection
