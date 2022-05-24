<div class="log-item" data-id="{{$log_id}}" data-url="{{$page_url}}" data-scraper_id="{scraper_id}" style="position: relative;">
    <div class="message-item margin-bottom-xs msg-error">
        {!! $page_url !!}
        <br>
        {!! $scraper_url !!}
    </div>
    @foreach($messages as $message)
    <div class="message-item margin-bottom-xs {{$message['status'] == 0 ? 'msg-error' : 'msg-info'}}">
        {!! $message['message'] !!}
    </div>
    @endforeach

    <div class="log-action">
        <a href="#" class="delete-log">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>clear</title>
                <g style="fill: var(--color-contrast-high)">
                    <path style="fill: var(--color-contrast-high)" d="M18.48 2.94h-5.16l-0.74-2.23a0.42 0.42 0 0 0-0.4-0.29h-4.2a0.42 0.42 0 0 0-0.4 0.29l-0.74 2.23h-5.16a0.42 0.42 0 0 0-0.42 0.42v1.26a0.42 0.42 0 0 0 0.42 0.42h16.8a0.42 0.42 0 0 0 0.42-0.42v-1.26a0.42 0.42 0 0 0-0.42-0.42z"></path><path d="M16.8 5.88h-13.44v11.76a2.1 2.1 0 0 0 2.1 2.1h9.24a2.1 2.1 0 0 0 2.1-2.1z m-9.66 10.08a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z m3.36 0a0.42 0.42 0 0 1-0.84 0v-6.3a0.42 0.42 0 0 1 0.84 0z"></path>
                </g>
            </svg>
        </a>
    </div>
</div>
