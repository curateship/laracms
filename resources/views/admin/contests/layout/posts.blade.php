@foreach($posts as $post)
    <div class="margin-bottom-sm flex justify-between items-center contest-follower">
        <div class="flex gap-sm items-center">
            <div>
                <div class="avatar contest-follower-avatar">
                    <figure class="avatar__figure admin-follow-avatar-box" role="img" aria-label="{{$post->title}}">
                        <a href="/user/{{$post->author()->username}}">{!! $post->author()->getAvatar(false, ['width' => 40, 'height' => 40], ['block'])->content !!}</a>
                    </figure>
                </div>
            </div>
            <div>
                <a href="/user/{{$post->author()->username}}" class="comments__author-name">{{$post->author()->name}}</a>
                <div>
                    <a href="/post/{{$post->slug}}" class="link-subtle">{{$post->title}}</a>
                </div>
            </div>
        </div>
        <fieldset class="contest-places-box" style="display: {{\Illuminate\Support\Facades\Auth::guest() ? 'none' : 'flex'}}">
            <ul class="flex gap-xxs">
                <li class="place-button place-{{$post->contest_place == 1 ? 1 : 'none'}}" data-post-id="{{$post->id}}" data-place="1">1</li>
                <li class="place-button place-{{$post->contest_place == 2 ? 2 : 'none'}}" data-post-id="{{$post->id}}" data-place="2">2</li>
                <li class="place-button place-{{$post->contest_place == 3 ? 3 : 'none'}}" data-post-id="{{$post->id}}" data-place="3">3</li>
            </ul>

            <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
                <li>
                    <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag choice-tag--checked" for="follow-button-input-{{$post->id}}" data-post-id="{{$post->id}}">
                        <input class="sr-only post-button-input" type="checkbox" id="follow-button-input-{{$post->id}}" checked data-contest-id="{{$post->contest_id}}" data-post-id="{{$post->id}}">
                        <svg class="choice-tag__icon icon" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                        <span class="follow-label" data-post-id="{{$post->id}}"></span>
                    </label>
                </li>
            </ul>
        </fieldset>
    </div>
@endforeach

<script>
    (function() {
        $(document).on('click', '.place-button', function(){
            const $this = $(this)
            const post_id = $this.attr('data-post-id')
            const place = $this.attr('data-place')
            let exist_place = $this.hasClass(`place-${place}`)

            $('.place-button').each(function(){
                $(this).removeClass(`place-${place}`)
            })

            $('.place-button[data-post-id="' + post_id + '"]').attr('class', 'place-button place-none')

            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    place: place,
                    post_id: post_id,
                    exist_place: exist_place
                },
                url: '/admin/contests/setPlace',
                type: 'POST',
                success:function(data){
                    if(parseInt(data.status) === 200){
                        if(exist_place){
                            $this.removeClass(`place-${place}`)
                            $this.addClass('place-none')
                        }   else{
                            $this.addClass(`place-${place}`)
                        }

                    }
                }
            });
        })
    }())
</script>
