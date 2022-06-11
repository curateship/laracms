@push('custom-scripts')
    @include('components.tags.show.scripts-js')
@endpush

<div class="text-component flex gap-md">
    @if($tag->thumbnail != '')
        <div class="tag-thumbnail-on-page">
            <div style="background-image: url('{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}')"></div>
        </div>
     @endif
        <div>
         <!-- Tag Title -->
         <div  style="display: flex;gap: 20px;align-items: center;">
             <h1 class="text-xl">{{ $tag->name }}</h1>

             <div class="choice-tags js-choice-tags">
                 <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$followed ? 'choice-tag--checked' : ''}}" for="follow-button-input-{{$tag->id}}" data-tag-id="{{$tag->id}}">
                     <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$tag->id}}" {{$followed ? 'checked' : ''}} data-tag-id="{{$tag->id}}">
                     <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                     <span class="follow-label" data-tag-id="{{$tag->id}}">{{$followed ? 'Unfollow' : 'Follow'}}</span>
                 </label>
             </div>
         </div>



        <!-- Tag body -->
        <div class="text-component padding-bottom-md">
            {!! $tag->body() !!}
        </div>
    </div>
 </div>
