<div class="text-component flex gap-md">
    @if($tag->thumbnail != '')
        <div class="tag-thumbnail-on-page">
            <div style="background-image: url('{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}')"></div>
        </div>
     @endif
        <div>
         <!-- Tag Title -->
        <h1 class="text-xl">{{ $tag->name }}</h1>

        <!-- Tag body -->
        <div class="text-component padding-bottom-md">
            {!! $tag->body() !!}
        </div>
    </div>
 </div>