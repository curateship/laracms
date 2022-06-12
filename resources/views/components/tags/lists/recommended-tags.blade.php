@foreach($tags as $tag)
    <div class="user-cell margin-bottom-xs">
        <!-- Image and Tag -->
        <div class="flex items-start">
            <a href="/tags/{{$tag->cat_name}}/{{$tag->slug}}" class="comments__author-img">
                @if($tag->thumbnail != null)
                    <img class="chip__img" src="{{url('/storage'.config('images.tags_storage_path').$tag->thumbnail)}}" alt="tag-icon">
                @else
                    <div style="height: 45px;width: 45px;background: var(--color-bg, white);"></div>
                @endif
            </a>
            <div class="margin-x-xs user-menu__meta">
                <a class="link-subtle" href="/tags/{{$tag->cat_name}}/{{$tag->slug}}">
                    <p class="text-sm">{{$tag->name}}</p>
                </a>
                <p class="text-xs color-contrast-medium line-height-1 padding-top-xxxxs">{{$tag->posts_count}} Posts</p>
            </div>
        </div>

        <!-- Follow Icon -->
        <div class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
            <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag {{$tag->follow_tag_id != null ? 'choice-tag--checked' : ''}}" for="follow-button-input-tag-{{$tag->id}}" data-tag-id="{{$tag->id}}">
                <input class="sr-only follow-button-input-tag" type="checkbox" id="follow-button-input-tag-{{$tag->id}}" {{$tag->follow_tag_id != null ? 'checked' : ''}} data-tag-id="{{$tag->id}}">
                <svg class="choice-tag__icon icon margin-right-xxs" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                <span class="follow-label" data-tag-id="{{$tag->id}}">{{$tag->follow_tag_id != null ? 'Unfollow' : 'Follow'}}</span>
            </label>
        </div>
    </div>

@endforeach
