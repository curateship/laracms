@extends('admin::layouts.master')
@section('content')
  <section>
    <div class="container max-width-lg">
      <div class="grid">
        @include('admin::partials.sidebar')
        <main class="position-relative z-index-1 col-12@md link-card radius-md">
          @include('admin::scraper.control')
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->

          <div class="padding-md">
            <div id="site-table-with-pagination-container">
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

              <form id="formSetting" method="POST">
                @csrf

                <div class="padding-">
                  <div class="margin-bottom-md">
                    <h3 class="text-md">Ip Radomize</h4>
                  </div>

                  <!-- /Repeater -->
                  <div class="js-repeater" data-repeater-input-name="scraper_ip_ports[n]">
                    <ul class="grid gap-xs js-repeater__list">
                      <?php
                        $s_idx = 0;
                      ?>
                    @foreach($scraper_ip_ports as $ip_port)
                      <li class="js-repeater__item">
                        <div class="grid gap-xs">
                          <input class="form-control col" type="text" name="scraper_ip_ports[{{$s_idx}}][ip]" id="scraper_ip_ports[{{$s_idx}}][ip]" value="{{$ip_port['ip']}}" placeholder="Add IP">
                          <input class="form-control col" type="text" name="scraper_ip_ports[{{$s_idx}}][port]" id="scraper_ip_ports[{{$s_idx}}][port]" value="{{$ip_port['port']}}" placeholder="Port">
                          <button class="btn btn--subtle padding-x-xs col-content js-repeater__remove" type="button">
                            <svg class="icon" viewBox="0 0 20 20">
                              <title>Remove item</title>

                              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <line x1="1" y1="5" x2="19" y2="5"/>
                                <path d="M7,5V2A1,1,0,0,1,8,1h4a1,1,0,0,1,1,1V5"/>
                                <path d="M16,8l-.835,9.181A2,2,0,0,1,13.174,19H6.826a2,2,0,0,1-1.991-1.819L4,8"/>
                              </g>
                            </svg>
                          </button>
                        </div>
                      </li>

                      <?php
                        $s_idx++;
                      ?>
                    @endforeach
                      <li class="js-repeater__item">
                        <div class="grid gap-xs">
                          <input class="form-control col" type="text" name="scraper_ip_ports[{{$s_idx}}][ip]" id="scraper_ip_ports[{{$s_idx}}][ip]" placeholder="Add IP">
                          <input class="form-control col" type="text" name="scraper_ip_ports[{{$s_idx}}][port]" id="scraper_ip_ports[{{$s_idx}}][port]" placeholder="Port">
                          <button class="btn btn--subtle padding-x-xs col-content js-repeater__remove" type="button">
                            <svg class="icon" viewBox="0 0 20 20">
                              <title>Remove item</title>
                  
                              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <line x1="1" y1="5" x2="19" y2="5"/>
                                <path d="M7,5V2A1,1,0,0,1,8,1h4a1,1,0,0,1,1,1V5"/>
                                <path d="M16,8l-.835,9.181A2,2,0,0,1,13.174,19H6.826a2,2,0,0,1-1.991-1.819L4,8"/>
                              </g>
                            </svg>
                          </button>
                        </div>
                      </li>
                    </ul>
                  
                    <button class="text-sm btn btn--subtle width-15% margin-top-xs js-repeater__add" type="button">Add IP</button>
                  </div> <!-- end of Repeater -->

                  <div class="margin-bottom-sm margin-top-lg">
                    <h3 class="text-md">Delays (Default from 5s - 15s)</h4>
                  </div>
                  <div class="input-merger form-control width-100% grid margin-bottom-sm">
                    <input type="number" min="5" max="15" class="reset input-merger__input min-width-0 col" name="delay_min" id="delay_min" value="{{$delay_min}}" placeholder="From" required>
                    <input type="number" min="5" max="15" class="reset input-merger__input min-width-0 col" name="delay_max" id="delay_max" value="{{$delay_max}}" placeholder="To" required>
                  </div>                  
                </div>

                <div class="text-right">
                  <button id="btnSave" type="submit" class="btn btn--primary margin-right-sm margin-top-lg">Save</button>
                </div>
              </form>
            </div><!-- /#site-table-with-pagination-container -->
          </div><!-- Padding -->
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection

@push('module-scripts')
  <!-- MODULE'S CUSTOM SCRIPT -->
  @include('admin::scraper.script-js')
@endpush
