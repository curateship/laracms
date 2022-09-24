@extends(config('theme.admin_app_template'))

@push('custom-scripts')
    @include('admin.posts.script-editor-js')
    @include('admin.posts.script-editor-js-image')
    @include('admin.posts.editorjs-custom-ext-url.custom-ext')
    @include('admin.posts.script-editor-js-header')
    @include('admin.posts.script-editor-js-embed')
    @include('admin.posts.script-editor-js-list')
    @include('admin.contests.script-js')
@endpush

@section('content')
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
                                    <a href="/admin/contests" class="color-inherit link-subtle">Contests</a>
                                    <svg class="icon margin-left-xxxs color-contrast-low" aria-hidden="true" viewBox="0 0 16 16"><polyline fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline></svg>
                                </li>
                                <li class="breadcrumbs__item color-contrast-high" aria-current="page">Create</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Table-->
                <div class="margin-top-auto border-top border-contrast-lower opacity-40%"></div><!-- Divider -->
                <div class="padding-md">
                    <form method="POST" action="{{ route('admin.contests.store') }}" id="new-post-form">
                        @csrf
                        <input type="hidden" name="contestId" value="{{$contest->id}}">
                        <fieldset class="margin-bottom-md">
                            <div class="margin-bottom-sm">
                                <input class="form-control width-100%" type="text" name="title" placeholder="Enter Your Title" value="{{$contest->title}}" required>
                            </div>
                            @error('title')
                            <p>{{ $message }}</p>
                            @enderror
                            <div>
                                <!--<textarea class="margin-bottom-sm form-control width-100%" name="description" id="" placeholder="Enter Description" rows="12"></textarea>-->
                                <div id="js-editor-description" data-target-input="#description" data-post-body="{{$contest->body}}" class="site-editor margin-bottom-sm form-control width-100%"></div>
                                <input type="hidden" name="description" id="description" required/>
                            </div>

                            <!-- Image Upload -->
                            <div class="file-upload inline-block margin-bottom-sm">
                                <label for="upload-file" class="file-upload__label btn btn--subtle">
                                  <span class="flex items-center">
                                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><g fill="none" stroke="currentColor" stroke-width="2"><path  stroke-linecap="square" stroke-linejoin="miter" d="M2 16v6h20v-6"></path><path stroke-linejoin="miter" stroke-linecap="butt" d="M12 17V2"></path><path stroke-linecap="square" stroke-linejoin="miter" d="M18 8l-6-6-6 6"></path></g></svg>
                                    <span class="margin-left-xxs file-upload__text file-upload__text--has-max-width">Upload Image</span>
                                  </span>
                                </label>
                                <input type="hidden" name="original" value="{{$contest->original}}"/>
                                <input type="hidden" name="thumbnail" value="{{$contest->thumbnail}}"/>
                                <input type="hidden" name="medium" value="{{$contest->medium}}"/>
                                <input type="file" class="file-upload__input" name="image" id="upload-file" accept="image/jpeg, image/jpg, image/png, image/gif">
                                <br>
                                <img alt="thumbnail" id="upload-thumbnail" class="margin-top-md" src="{{ url('/storage').config('images.contests_storage_path').$contest->thumbnail  }}" style="">
                            </div>
                        </fieldset>

                        <div class="flex gap-sm justify-end">
                            <input type="hidden" name="status" value="">
                            <div class="flex justify-end gap-xs">
                                <button type="button" class="btn btn--primary postSaveAs" data-status="draft">Save as draft</button>
                            </div>
                            <div class="flex justify-end gap-xs">
                                <button type="button" class="btn btn--primary postSaveAs" data-status="published">Publish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-3@md">
            @if(\Illuminate\Support\Facades\Gate::allows('is-admin'))
                @include('admin.partials.sidebar-admin')
            @else
                @include('admin.partials.sidebar')
            @endif
        </div>
    </div>
@endsection
