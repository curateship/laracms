@foreach($follows as $follow)
    <div class="margin-bottom-sm flex justify-between items-center contest-follower">
        <div class="flex gap-sm items-center">
            <div>
                <div class="avatar contest-follower-avatar">
                    <figure class="avatar__figure admin-follow-avatar-box" role="img" aria-label="{{$follow->name}}">
                        <a href="/user/{{$follow->username}}">{!! $follow->getAvatar(false, ['width' => 40, 'height' => 40], ['block'])->content !!}</a>
                    </figure>
                </div>
            </div>
            <div>
                <a href="/user/{{$follow->username}}" class="comments__author-name">{{$follow->name}}</a>
            </div>
        </div>
        <fieldset class="contest-places-box" style="display: {{\Illuminate\Support\Facades\Auth::guest() ? 'none' : 'flex'}}">
            @if($follow->post_id != null)
                <ul class="flex gap-xxs">
                    <li class="place-button place-{{$follow->contest_place == 1 ? 1 : 'none'}}" data-follow-id="{{$follow->follow_id}}" data-place="1">1</li>
                    <li class="place-button place-{{$follow->contest_place == 2 ? 2 : 'none'}}" data-follow-id="{{$follow->follow_id}}" data-place="2">2</li>
                    <li class="place-button place-{{$follow->contest_place == 3 ? 3 : 'none'}}" data-follow-id="{{$follow->follow_id}}" data-place="3">3</li>
                </ul>
            @endif

            <ul class="choice-tags flex flex-wrap gap-xxs js-choice-tags">
                <li>
                    <label class="choice-tag choice-tag--checkbox text-sm js-choice-tag choice-tag--checked" for="follow-button-input-{{$follow->follow_id}}" data-follow-id="{{$follow->follow_id}}">
                        <input class="sr-only follow-button-input" type="checkbox" id="follow-button-input-{{$follow->follow_id}}" checked data-follow-id="{{$follow->follow_id}}" data-contest-id="{{$follow->follow_contest_id}}">
                        <svg class="choice-tag__icon icon" viewBox="0 0 16 16" aria-hidden="true"><g class="choice-tag__icon-group" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2"><line x1="-6" y1="8" x2="8" y2="8" /><line x1="8" y1="8" x2="22" y2="8"/><line x1="8" y1="2" x2="8" y2="14"/></g></svg>
                        <span class="follow-label" data-follow-id="{{$follow->follow_id}}"></span>
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
            const follow_id = $this.attr('data-follow-id')
            const place = $this.attr('data-place')
            let exist_place = $this.hasClass(`place-${place}`)

            $('.place-button').each(function(){
                $(this).removeClass(`place-${place}`)
            })

            $('.place-button[data-follow-id="' + follow_id + '"]').attr('class', 'place-button place-none')

            $.ajax({
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    place: place,
                    follow_id: follow_id,
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
