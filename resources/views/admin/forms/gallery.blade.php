@if(!isset($post))
    @include('admin.posts.script-multi-upload')
@endif

<!-- Image Upload -->
<div class="file-upload inline-block margin-bottom-sm">
    <label for="upload-file" class="file-upload__label btn btn--subtle">
    <span class="flex items-center">
      <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
      <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload Main Image</span>
    </span>
    </label>
    <input type="hidden" name="original" value="{{isset($post) ? $post->original : ''}}"/>
    <input type="hidden" name="thumbnail" value="{{isset($post) ? $post->thumbnail : ''}}"/>
    <input type="hidden" name="medium" value="{{isset($post) ? $post->medium : ''}}"/>
    <input type="hidden" name="type" value="gallery"/>
    <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif, image/gif">
    <br>
    <div id="uploading-progress-bar" class="progress-bar progress-bar--color-update flex flex-column items-center js-progress-bar margin-top-md" style="display: none;">
        <div class="progress-bar__bg " aria-hidden="true">
            <div class="progress-bar__fill " style="width: 0%;"></div>
        </div>
    </div>

    <div id="upload-thumbnail" class="margin-top-md">
        @if(isset($post))
            <img alt="thumbnail" src="{{'/storage'.config('images.posts_storage_path').$post->thumbnail}}">
        @endif
    </div>
</div>

<!-- Gallery Upload -->
<div class="file-upload-m inline-block margin-bottom-sm" style="width: 100%;">
    <div class="row">
        <div id="uploads-box">
            @if(isset($post))
                @foreach($posts_files as $file)
                    <input type="hidden" name="uploaded-images[]" value="{{$file}}">
                @endforeach
            @endif
        </div>

        <div id="preview-box" style="position: relative;">
            @if(isset($post))
                @foreach($posts_urls as $url)
                    <img class="upload-preview" alt="upload-preview" data-filename="{{basename($url)}}" src="{{$url}}">
                @endforeach
            @endif
        </div>

        <div class="col-md-6 col-sm-12">

            <!-- Our markup, the important part here! -->
            <div id="drag-and-drop-zone" class="dm-uploader p-5">
                <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files for gallery here</h3>

                <div class="btn btn-primary btn-block mb-5">
                    <span>Open the file Browser</span>
                    <input type="file" title='Click to add Files' accept="image/jpeg, image/jpg, image/png, image/gif, image/gif"/>
                </div>
            </div><!-- /uploader -->

        </div>
        <div class="col-md-6 col-sm-12">
            <div class="class card h-100 files-box">
                <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                    <li class="text-muted text-center empty">No files uploaded.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- File item template -->
    <script type="text/html" id="files-template">
        <li class="media">
            <div class="media-body mb-1">
                <p class="mb-2">
                    <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                </p>
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary upload-progress"
                         role="progressbar"
                         style="width: 0%"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <hr class="mt-1 mb-1" />
            </div>
        </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
        <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
</div>
