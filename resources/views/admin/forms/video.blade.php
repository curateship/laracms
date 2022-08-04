<!-- Image Upload -->
<div class="file-upload inline-block margin-bottom-sm">
  <label for="upload-file" class="file-upload__label btn btn--subtle">
    <span class="flex items-center">
      <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
      <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload From File</span>
    </span>
  </label>
    <input type="hidden" name="original" value=""/>
    <input type="hidden" name="thumbnail" value=""/>
    <input type="hidden" name="medium" value=""/>
    <input type="hidden" name="type" value=""/>
    <input type="hidden" name="video_original" value=""/>
    <input type="hidden" name="video_thumbnail" value=""/>
    <input type="hidden" name="video_medium" value=""/>
    <input type="file" class="file-upload__input" name="image" id="upload-file" accept="video/mp4, video/webm" required>
    <br>
    <div id="uploading-progress-bar" class="progress-bar progress-bar--color-update flex flex-column items-center js-progress-bar margin-top-md" style="display: none;">
        <div class="progress-bar__bg " aria-hidden="true">
            <div class="progress-bar__fill " style="width: 0%;"></div>
        </div>
    </div>
    <div id="upload-thumbnail" class="margin-top-md"></div>

    <div class="flex justify-end gap-xs margin-top-md">
        <label>
            <input class="form-control width-100%" type="text" name="video-external-url" placeholder="Enter External File URL" value="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4">
        </label>
        <button type="button" id="url-upload" class="btn btn--sm btn--accent">Upload From URL</button>
    </div>
</div>
