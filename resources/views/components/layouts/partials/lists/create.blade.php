<div class="padding-sm">
    <div class="form-group">
        <input class="form-control" id="new-favorite-name" placeholder="New list name" style="width: 100%;margin-bottom: 10px;">
    </div>

    <div class="form-group margin-bottom-xs" style="display: flex;gap: 20px;align-items: center;">
        <input class="radio" type="radio" name="direction" value="1" id="fav-public" checked>
        <label for="fav-public">Public</label>

        <input class="radio" type="radio" name="direction" value="0" id="fav-private">
        <label for="fav-private">Private</label>
    </div>

    <div>
        <!-- Image Upload -->
        <div class="file-upload inline-block margin-bottom-sm">
            <label for="upload-file" class="file-upload__label btn btn--subtle" tabindex="0">
                    <span class="flex items-center">
                      <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
                      <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload Image</span>
                    </span>
            </label>
            <input type="hidden" name="original" value="">
            <input type="hidden" name="thumbnail" value="">
            <input type="hidden" name="medium" value="">
            <input type="hidden" name="type" value="">
            <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif, image/gif" required="" tabindex="-1">
            <br>
            <div id="uploading-progress-bar" class="progress-bar progress-bar--color-update flex flex-column items-center js-progress-bar margin-top-md progress-bar--fill-color-3 progress-bar--init" style="display: none;">
                <div class="progress-bar__bg " aria-hidden="true">
                    <div class="progress-bar__fill " style="width: 0%;"></div>
                </div>
            </div>
            <img id="upload-thumbnail" src="" class="margin-top-md" alt="list-logo" style="display: none;max-height: 90px;max-width: 90px;">
        </div>
    </div>

    <div style="display: flex; justify-content: space-between">
        <button class="btn add-new-favorite-button-cancel btn--accent">Back</button>
        <button class="btn btn--primary" id="create-new-list">Create</button>
    </div>

</div>
