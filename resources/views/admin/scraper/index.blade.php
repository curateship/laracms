@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.scraper.script-js')
    @include('admin.scraper.log-loader-js')
@endpush

@section('content')
<div class="container max-width-adaptive-lg">
  <div class="grid gap-md justify-between">
    <div class="col-12@md"><!-- 👇 Col 12 -->
      <div class="card" data-table-controls="table-1"><!-- Content Table Column -->

       @foreach($scrapers as $scraper)
          <div class="flex justify-between scraper-item" data-id="{{ $scraper->id }}">
            <div class="margin-xs">
              <h3 class="text-md padding-xxs">Scraper for{{ isset($scraper->domain) && !empty($scraper->domain) ? " - " . $scraper->domain : "" }}</h3>
            </div>

            <!-- Menu Bar -->
            <div class="flex flex-wrap items-center justify-between margin-right-xxs">
              <div class="flex flex-wrap">

                <li class="menu-bar__item">
                  <a class="btn-scraper-stop" href="#">
                  <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 16h8V8H8v8zm4-14C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"></path>
                  </svg>                  </a>
                  <span class="menu-bar__label">Stop</span>
                </li>

              </div>
            </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
          </div><!-- .flex -->
          @endforeach

      </div><!-- END Col-12 Card -->
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
  </div><!-- Grid END -->
</div>

@endsection