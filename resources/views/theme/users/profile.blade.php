@extends('admin.layouts.app')
@section('content')

<div class="container max-width-adaptive-lg padding-top-md">
  <div class="grid gap-md">

    <!-- User Informations -->
    <div class="col-4@md margin-bottom-md">
      <div class="card margin-bottom-sm">
        @include('components.users.user-bio-card')
      </div>

        <!-- Following -->
        <div class="card">
            <div class="flex justify-between items-baseline padding-sm">
                <h1 class="text-base color-contrast-medium">Following ({{count($following)}})</h1>
                <a class="text-sm link-plain" href="#0">View all</a>
            </div>
            <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
            @include('components.users.lists.my-followers', ['follow_list' => $following])
        </div>

      <!-- Followers -->
        <div class="card margin-top-sm">
            <div class="flex justify-between items-baseline padding-sm">
              <h1 class="text-base color-contrast-medium">Followers ({{count($followers)}})</h1>
              <a class="text-sm link-plain" href="#0">View all</a>
            </div>
            <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
              @include('components.users.lists.my-followers', ['follow_list' => $followers])
        </div>
    </div>

    <!-- Users Posts -->
    <div class="col-8@md">
        <h1 class="text-xl padding-bottom-md">{{$user->name}}'s Posts</h1>
        @include('components.users.lists.users-posts')
    </div>

  </div>
</div>

@endsection
