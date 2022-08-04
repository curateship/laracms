@extends(env('MAIN_APP_TEMPLATE'))
@section('content')

<!-- 👇 Content Body Wrapper-->
<section class="margin-y-xl">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md justify-between">
      <div class="col-12@md">

        <!-- Content Table Column -->
        <div class="card" data-table-controls="table-1">

        <!-- Control Bar -->
        <div class="controlbar--sticky flex justify-between">
            <div class="inline-flex items-baseline">

              <!-- Bread Crumb -->
              <nav class="breadcrumbs text-based padding-left-sm padding-sm" aria-label="Breadcrumbs">
                <ol class="flex flex-wrap gap-xxs">

                  <li class="breadcrumbs__item color-contrast-low">
                    <a href="/admin" class="color-inherit link-subtle">Home</a>
                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                  </li>

                  <li class="breadcrumbs__item color-contrast-low">
                    <a href="/admin/categories" class="color-inherit link-subtle">Categories</a>
                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                  </li>

                  <li class="breadcrumbs__item color-contrast-high" aria-current="page">Create</li>
                </ol>
              </nav>
              <!-- Bread Crumb END -->
        </div>
        <!-- END Control Bar-->

    <!-- Menu Bar -->
    <div class="flex flex-wrap items-center justify-between margin-right-sm">
      <div class="flex flex-wrap">
        <menu class="menu-bar js-int-table-actions__no-items-selected js-menu-bar">

          <li class="menu-bar__item" role="menuitem" aria-controls="post-search">
            <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
              <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
            </svg>
            <span class="menu-bar__label">Search Categories</span>
          </li>
        </menu>

      </div><!-- END Control Bar -->
    </div>
  </div><!-- END card -->
<!-- END Control Bar-->

<!-- Table-->
<div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
<div class="padding-md">
<form action="{{ route('admin.categories.store') }}" method='post'>@csrf

  <fieldset class="margin-bottom-xxs">

    <div class="margin-bottom-sm">
      <input class="form-control width-100%" type="text" value='{{ old("name") }}' name="name" id="inputtitle" placeholder="Enter Your Title" required>
    </div>
    @error('title')
    <p>{{ $message }}</p>
    @enderror

    <div class="margin-bottom-sm">
      <input class="form-control width-100%" type="text" value='{{ old("slug") }}' name="slug" id="inputtitle" placeholder="Enter Your Slug" required>
    </div>
    @error('slug')
    <p>{{ $message }}</p>
    @enderror

  </fieldset>

  <div class="flex justify-end gap-xs">
        <button class="btn btn--primary">Create</button>
      </div>
   </form>
</div>
<!-- END Table-->



        </div><!-- END Col-12 Card Wrapper -->
      </div><!-- Col-12 END -->

      <!-- Sidebar -->
      <div class="col-3@md">
          @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
              @include('admin.partials.sidebar-admin')
          @else
              @include('admin.partials.sidebar')
          @endif
      </div>
      <!-- Sidebar END -->

    </div><!-- Grid END (col-12 and col-3) -->
  </div><!-- Container Wrapper END -->
</section
@endsection
