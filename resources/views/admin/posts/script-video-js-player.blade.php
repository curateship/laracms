<video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="{{$player_width}}"
    height="{{$player_height}}"
    poster="{{$poster}}"

    @if(isset($auto_width))
    data-setup='{"fluid": true}'
    @else
    data-setup='{}'
    @endif
>
    <source src="{{$video_mp4}}" type="video/mp4" />
    <source src="{{$video_webm}}" type="video/webm" />

    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
        >
    </p>
</video>

@include('admin.posts.script-video-js')
