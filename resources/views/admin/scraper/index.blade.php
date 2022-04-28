@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.scraper.script-js')
    @include('admin.scraper.log-loader-js')
@endpush

@section('content')
  <section>
    <div class="container max-width-lg">
      <div class="grid">
        <main class="position-relative z-index-1 col-15@md link-card radius-md">
          @include('admin.scraper.control')
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->

          @csrf

          <div class="alert alert-main js-alert margin-bottom-lg" role="alert">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 32 32" ><title>info icon</title><g><path d="M16,0C7.178,0,0,7.178,0,16s7.178,16,16,16s16-7.178,16-16S24.822,0,16,0z M18,7c1.105,0,2,0.895,2,2 s-0.895,2-2,2s-2-0.895-2-2S16.895,7,18,7z M19.763,24.046C17.944,24.762,17.413,25,16.245,25c-0.954,0-1.696-0.233-2.225-0.698 c-1.045-0.92-0.869-2.248-0.542-3.608l0.984-3.483c0.19-0.717,0.575-2.182,0.036-2.696c-0.539-0.514-1.794-0.189-2.524,0.083 l0.263-1.073c1.054-0.429,2.386-0.954,3.523-0.954c1.71,0,2.961,0.855,2.961,2.469c0,0.151-0.018,0.417-0.053,0.799 c-0.066,0.701-0.086,0.655-1.178,4.521c-0.122,0.425-0.311,1.328-0.311,1.765c0,1.683,1.957,1.267,2.847,0.847L19.763,24.046z"></path></g></svg>
                <div class="msg-container">
                </div>
              </div>

              <button class="reset alert__close-btn js-alert__close-btn">
                <svg class="icon" viewBox="0 0 24 24"><title>Close alert</title><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" stroke="currentColor" fill="none" stroke-miterlimit="10"><line x1="19" y1="5" x2="5" y2="19"></line><line fill="none" x1="19" y1="19" x2="5" y2="5"></line></g></svg>
              </button>
            </div>
          </div>

          @foreach($scrapers as $scraper)
          <div class="flex justify-between scraper-item" data-id="{{ $scraper->id }}">
            <div class="margin-xs">
              <h3 class="text-md padding-xxs">Scraper for{{ isset($scraper->domain) && !empty($scraper->domain) ? " - " . $scraper->domain : "" }}</h3>
            </div>

            <!-- Menu Bar -->
            <div class="flex flex-wrap items-center justify-between margin-right-xxs">
              <div class="flex flex-wrap">
                <li class="menu-bar__item js-menu-bar">
                  @if($scraper->status == 'paused')
                    <a class="btn-scraper-run-pause" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><title>triangle-sm-right</title><g fill="#000000"><path fill="#000000" d="M20.66 13.94l-10-6.25a1.25 1.25 0 0 0-1.91 1.06v12.5a1.25 1.25 0 0 0 1.91 1.06l10-6.25a1.25 1.25 0 0 0 0-2.12z"></path></g></svg></a>
                    <span class="menu-bar__label">Continue</span>
                  @else
                    <a class="btn-scraper-run-pause" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>button-pause</title><g fill="#000000"><path fill="#000000" d="M6.25 1.25h-3.75c-0.75 0-1.25 0.5-1.25 1.25v15c0 0.75 0.5 1.25 1.25 1.25h3.75c0.75 0 1.25-0.5 1.25-1.25v-15c0-0.75-0.5-1.25-1.25-1.25z"></path><path fill="#000000" d="M17.5 1.25h-3.75c-0.75 0-1.25 0.5-1.25 1.25v15c0 0.75 0.5 1.25 1.25 1.25h3.75c0.75 0 1.25-0.5 1.25-1.25v-15c0-0.75-0.5-1.25-1.25-1.25z"></path></g></svg>
                    </a>
                    <span class="menu-bar__label">Pause</span>
                  @endif
                </li>

                <li class="menu-bar__item">
                  <a class="btn-scraper-stop" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>shape-oval</title><g fill="#000000"><path fill="#000000" d="M9.98 0a9.98 9.98 0 1 0 0 19.97 9.98 9.98 0 1 0 0-19.97z"></path></g></svg>
                  </a>
                  <span class="menu-bar__label">Stop</span>
                </li>

                <li class="menu-bar__item">
                  <a class="btn-scraper-delete" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>trash</title><g fill="#000000"><path d="M18.48 2.94h-5.16l-0.74-2.23a0.42 0.42 0 0 0-0.4-0.29h-4.2a0.42 0.42 0 0 0-0.4 0.29l-0.74 2.23h-5.16a0.42 0.42 0 0 0-0.42 0.42v1.26a0.42 0.42 0 0 0 0.42 0.42h16.8a0.42 0.42 0 0 0 0.42-0.42v-1.26a0.42 0.42 0 0 0-0.42-0.42z"></path><path d="M16.8 5.88h-13.44v11.76a2.1 2.1 0 0 0 2.1 2.1h9.24a2.1 2.1 0 0 0 2.1-2.1z m-9.66 10.08a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z" fill="#000000"></path></g></svg>
                  </a>
                  <span class="menu-bar__label">Trash</span>
                </li>

                <li class="menu-bar__item">
                  <a href="{{ url('admin/scraper/scraper-v1') . '/' . $scraper->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>privacy-settings</title><g fill="#000000"><path d="M17.32 11.17a6.9 6.9 0 0 0 0-2.42l1.75-1.68a0.83 0.83 0 0 0 0.14-1.01l-1.25-2.16a0.84 0.84 0 0 0-0.95-0.38l-2.32 0.66a7.48 7.48 0 0 0-2.1-1.2l-0.58-2.35a0.83 0.83 0 0 0-0.8-0.63h-2.49a0.83 0.83 0 0 0-0.81 0.63l-0.59 2.35a7.49 7.49 0 0 0-2.09 1.2l-2.32-0.66a0.84 0.84 0 0 0-0.95 0.38l-1.25 2.16a0.83 0.83 0 0 0 0.14 1.01l1.75 1.68a7.62 7.62 0 0 0-0.11 1.21 7.53 7.53 0 0 0 0.11 1.21l-1.75 1.68a0.83 0.83 0 0 0-0.14 1.01l1.25 2.16a0.83 0.83 0 0 0 0.72 0.41 0.85 0.85 0 0 0 0.22-0.03l2.33-0.66a7.49 7.49 0 0 0 2.1 1.2l0.58 2.35a0.83 0.83 0 0 0 0.81 0.63h2.49a0.83 0.83 0 0 0 0.8-0.63l0.59-2.35a7.49 7.49 0 0 0 2.09-1.2l2.33 0.66a0.85 0.85 0 0 0 0.22 0.03 0.83 0.83 0 0 0 0.72-0.41l1.25-2.16a0.83 0.83 0 0 0-0.14-1.01z m-6.53 0.3v1.81h-1.66v-1.81a2.49 2.49 0 1 1 1.66 0z" fill="#000000"></path></g></svg>
                  </a>
                  <span class="menu-bar__label">Settings</span>
                </li>
              </div>
            </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
          </div><!-- .flex -->
          @endforeach

          <div class="flex justify-between">
            <div class="margin-xs">
              <h4 class="text-md padding-sm">Logs</h4>
            </div>

            <div class="flex flex-wrap items-center justify-between margin-right-xxs">
              <div class="flex flex-wrap rescrape-toolbar">
                <li class="menu-bar__item">
                  @if($re_scraper_status == 'stopped')
                    <a class="btn-scraper-try-again" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><title>triangle-sm-right</title><g fill="#000000"><path fill="#000000" d="M20.66 13.94l-10-6.25a1.25 1.25 0 0 0-1.91 1.06v12.5a1.25 1.25 0 0 0 1.91 1.06l10-6.25a1.25 1.25 0 0 0 0-2.12z"></path></g></svg>
                    </a>
                    <span class="menu-bar__label">Re-scrape All</span>
                  @else
                    <a class="btn-scraper-try-again" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>shape-oval</title><g fill="#000000"><path fill="#000000" d="M9.98 0a9.98 9.98 0 1 0 0 19.97 9.98 9.98 0 1 0 0-19.97z"></path></g></svg>
                    </a>
                    <span class="menu-bar__label">Stop Re-scraper</span>
                  @endif
                </li>

                <li class="menu-bar__item">
                  <a class="btn-logs-clear" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>clear</title><g fill="#000000"><path d="M18.48 2.94h-5.16l-0.74-2.23a0.42 0.42 0 0 0-0.4-0.29h-4.2a0.42 0.42 0 0 0-0.4 0.29l-0.74 2.23h-5.16a0.42 0.42 0 0 0-0.42 0.42v1.26a0.42 0.42 0 0 0 0.42 0.42h16.8a0.42 0.42 0 0 0 0.42-0.42v-1.26a0.42 0.42 0 0 0-0.42-0.42z"></path><path d="M16.8 5.88h-13.44v11.76a2.1 2.1 0 0 0 2.1 2.1h9.24a2.1 2.1 0 0 0 2.1-2.1z m-9.66 10.08a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z" fill="#000000"></path></g></svg>
                  </a>
                  <span class="menu-bar__label">Clear Logs</span>
                </li>
              </div>
            </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
          </div>
          <div id="logs-section" class="logs-section margin-left-sm margin-right-sm padding-sm text-sm">
          </div>
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>

  <div id="log_template" style="display:none">
    <div class="log-item" data-id="{log_id}" data-url="{page_url}" data-scraper_id="{scraper_id}">
      {messages}
    </div>
  </div>
  <div id="log_message_template" style="display:none">
    <div class="message-item {status_class}">
      {message}
    </div>
    <div class="log-action"><a href="#" class="delete-log"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>clear</title><g fill="#000000"><path d="M18.48 2.94h-5.16l-0.74-2.23a0.42 0.42 0 0 0-0.4-0.29h-4.2a0.42 0.42 0 0 0-0.4 0.29l-0.74 2.23h-5.16a0.42 0.42 0 0 0-0.42 0.42v1.26a0.42 0.42 0 0 0 0.42 0.42h16.8a0.42 0.42 0 0 0 0.42-0.42v-1.26a0.42 0.42 0 0 0-0.42-0.42z"></path><path d="M16.8 5.88h-13.44v11.76a2.1 2.1 0 0 0 2.1 2.1h9.24a2.1 2.1 0 0 0 2.1-2.1z m-9.66 10.08a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z" fill="#000000"></path></g></svg></a></div>
  </div>
@endsection
