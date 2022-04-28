@extends('admin.layouts.app')

@push('custom-scripts')
    @include('admin.scraper.script-js')
@endpush

@section('content')
  <section>
    <div class="container max-width-lg">
      <div class="grid">
        <main class="position-relative z-index-1 col-15@md link-card radius-md">
          @include('admin.scraper.control')
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->

          <div class="padding-md">
            <form id="formScraper" method="POST" action="{{ url('/scraper/scraper-v1') }}">
              @csrf
              <input type="hidden" name="action" value="{{$action}}" />
              <input type="hidden" name="scraper_id" value="{{isset($scraper_id) ? $scraper_id : ''}}" />

              <!-- Users select dropdown -->
              <h3 class="text-md padding-bottom-sm">Scraper for{{ isset($scraper_domain) && !empty($scraper_domain) ? " - " . $scraper_domain : "" }}</h3>

              @if($alert = session()->get('alert'))
                <div class="alert alert--is-visible js-alert margin-bottom-lg {{ $alert['class'] }}" role="alert">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                      <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 32 32" ><title>info icon</title><g><path d="M16,0C7.178,0,0,7.178,0,16s7.178,16,16,16s16-7.178,16-16S24.822,0,16,0z M18,7c1.105,0,2,0.895,2,2 s-0.895,2-2,2s-2-0.895-2-2S16.895,7,18,7z M19.763,24.046C17.944,24.762,17.413,25,16.245,25c-0.954,0-1.696-0.233-2.225-0.698 c-1.045-0.92-0.869-2.248-0.542-3.608l0.984-3.483c0.19-0.717,0.575-2.182,0.036-2.696c-0.539-0.514-1.794-0.189-2.524,0.083 l0.263-1.073c1.054-0.429,2.386-0.954,3.523-0.954c1.71,0,2.961,0.855,2.961,2.469c0,0.151-0.018,0.417-0.053,0.799 c-0.066,0.701-0.086,0.655-1.178,4.521c-0.122,0.425-0.311,1.328-0.311,1.765c0,1.683,1.957,1.267,2.847,0.847L19.763,24.046z"></path></g></svg>
                      <div>
                        @if(isset($alert['error']))
                          @foreach($alert['error'] as $error)
                          <p>{{ $error }}</p>
                          @endforeach
                        @else
                          {!! $alert['message'] !!}
                        @endif
                      </div>
                    </div>

                    <button class="reset alert__close-btn js-alert__close-btn">
                      <svg class="icon" viewBox="0 0 24 24"><title>Close alert</title><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" stroke="currentColor" fill="none" stroke-miterlimit="10"><line x1="19" y1="5" x2="5" y2="19"></line><line fill="none" x1="19" y1="19" x2="5" y2="5"></line></g></svg>
                    </button>
                  </div>
                </div><!-- /.alert -->
              @endif

              <div class="adv-select js-adv-select">
                <select name="scraper_user" id="adv-select">
                  <optgroup label="Admins">
                    @foreach($users['admin'] as $user)
                        <!--
                      <div class="flex width-md height-md bg-black bg-opacity-50% radius-50% margin-right-xxs">
                          <img alt="user-avatar" class="width-md height-md radius-50% object-cover" src="{{url('/storage'.config('images.users_storage_path').$user->thumbnail)}}">
                      </div>
                      -->
                      <option value="{{$user->id}}" data-option-avatar="" {{ isset($scraper_info->user_id) && $scraper_info->user_id == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                    @endforeach
                  </optgroup>

                  <optgroup label="Editors">
                    @foreach($users['editor'] as $user)
                        <!--
                      <div class="flex width-md height-md bg-black bg-opacity-50% radius-50% margin-right-xxs">
                          <img alt="user-avatar" class="width-md height-md radius-50% object-cover" src="{{url('/storage'.config('images.users_storage_path').$user->thumbnail)}}">
                      </div>
                      -->
                      <option value="{{$user->id}}" data-option-avatar="" {{ isset($scraper_info->user_id) && $scraper_info->user_id == $user->id ? "selected" : ""}}>{{$user->name}}</option>
                    @endforeach
                  </optgroup>
                </select>

                <button class="adv-select__control btn btn--subtle is-hidden js-adv-select__control" aria-controls="adv-select-popover-1" aria-haspopup="listbox">
                  <span class="js-adv-select__value">
                    <!-- dynamically updated with the .adv-select-popover__option content -->
                  </span>

                  <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><path d="M10.947,3.276A.5.5,0,0,0,10.5,3h-9a.5.5,0,0,0-.4.8l4.5,6a.5.5,0,0,0,.8,0l4.5-6A.5.5,0,0,0,10.947,3.276Z"/></svg>
                </button>
              </div> <!-- end of <div class="adv-select js-adv-select"> -->

              <div id="adv-select-popover-1" class="adv-select-popover popover bg padding-y-xxs radius-md shadow-md is-hidden js-popover js-adv-select-popover js-tab-focus" role="listbox">
                <div class="adv-select-popover__optgroup" role="group" describedby="optgroup-label">
                  <!-- label -->
                  <div id="optgroup-label" class="adv-select-popover__label text-sm color-contrast-medium padding-y-xs padding-x-md">{optgroup-label}</div>

                  <!-- option -->
                  <div class="adv-select-popover__option padding-y-xxs padding-x-md" role="option">
                    <div class="flex items-center">
                      {option-avatar}
                      <div class="text-truncate">{option-label}</div>
                      <svg class="adv-select-popover__check icon icon--xs margin-left-auto" viewBox="0 0 16 16"><polyline stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" points="1,9 5,13 15,3" /></svg>
                    </div>
                  </div>
                </div>
              </div> <!-- end of #adv-select-popover-1 -->
              <!-- Users select End -->

              <div class="padding-top-md">
                <fieldset class="margin-bottom-md padding-bottom-md">
                  <div class="text-component margin-bottom-md text-left">
                    <h3 class="text-md padding-bottom-sm">Index Crawl (Level 1)</h4>

                    <div class="margin-bottom-sm">
                      <div class="grid gap-xs">
                        <div class="col-6@md">
                          <input class="form-control width-100%" type="text" name="default_url" id="default_url" value="{{ isset($scraper_info->default_url) ? $scraper_info->default_url : old('default_url')}}" placeholder="https://domain.com/page/2641/">
                        </div>

                        <div class="col-6@md padding-top-xxs padding-left-md">
                          <input class="radio" type="radio" name="direction" value="0" id="dir_backward" {{(!isset($scraper_info->direction) && old('default_url') == 0) || (isset($scraper_info->direction) && $scraper_info->direction == 0) ? "checked" : ""}}>
                          <label for="dir_backward">Backward</label>

                          <input class="radio" type="radio" name="direction" value="1" id="dir_forward" {{(!isset($scraper_info->direction) && old('default_url') == 1) || (isset($scraper_info->direction) && $scraper_info->direction == 1) ? "checked" : ""}}>
                          <label for="dir_forward">Forward</label>
                        </div>

                        <div>
                          <p class="text-sm color-contrast-medium">Acceptable url format:</p>
                          <p class="text-sm color-contrast-medium">https://www.example.com/<strong>{page|pages|pg}/{page_number}</strong>/</p>
                          <p class="text-sm color-contrast-medium">https://www.example.com/?<strong>{page|pages|pg}={page_number}</strong></p>
                          <p class="text-sm color-contrast-medium">* Only accept "page", "pages", "pg" pagination parameters.</p>
                        </div>

                        <div class="margin-bottom-sm margin-top-sm">
                          <input class="form-control width-100%" name="item_url" value="{{ isset($scraper_info->item_url) ? $scraper_info->item_url : old('item_url')}}" placeholder="all URLs with the thumb class" >
                          <p class="margin-top-sm text-sm color-contrast-medium">Available Format: &lt;title&gt;(HTML tag name), #item-id, .item-class (CSS selector), Text Content(Text content of HTML element)</p>
                          <p class="margin-top-sm text-sm color-contrast-medium">This is same for all element at Level 2.</p>
                        </div>
                      </div> <!-- end of <div class="grid gap-xs"> -->
                    </div>

                    <h3 class="text-md padding-top-md">Individual Page Crawl (Level 2)</h4>
                    <div class="margin-bottom-sm">
                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="title" value="{{ isset($scraper_info->title) ? $scraper_info->title : old('title')}}" placeholder="Title" >
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="image" value="{{ isset($scraper_info->image) ? $scraper_info->image : old('image')}}" placeholder="Image" >
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="video" value="{{ isset($scraper_info->video) ? $scraper_info->video : old('video')}}" placeholder="Video" >
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="artist" value="{{ isset($scraper_info->artist) ? $scraper_info->artist : old('artist')}}" placeholder="Artist">
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="origins" value="{{ isset($scraper_info->origins) ? $scraper_info->origins : old('origins')}}" placeholder="Origins">
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="character" value="{{ isset($scraper_info->character) ? $scraper_info->character : old('character')}}" placeholder="Character">
                      </div>

                      <div class="margin-bottom-sm margin-top-md">
                        <input class="form-control width-100%" name="media" value="{{ isset($scraper_info->media) ? $scraper_info->media : old('media')}}" placeholder="Media">
                      </div>

                      <div class="margin-top-md">
                        <input class="form-control width-100%" name="misc" value="{{ isset($scraper_info->misc) ? $scraper_info->misc : old('misc')}}" placeholder="Misc">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <div class="text-right">
                  <button type="submit" class="btn btn--subtle margin-right-sm btn-save">Save</button>
                  <button type="submit" class="btn btn--primary btn-do-scrape">Scrape</button>
                </div>
              </div>
            </div><!-- end of <div class="padding-md"> -->
          </form>
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection
