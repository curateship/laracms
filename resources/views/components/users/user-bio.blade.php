<div class="profile-author-box" style="background-image: url('{{ url('/storage'.config('images.users_storage_path').$user->cover_medium) }}')"></div>
    <!-- Author Picture -->
    <div class="author author--featured padding-bottom-sm profile-author-avatar">
        <a href="/user/{{$user->id}}" class="author__img-wrapper">
            <img src="{{ url('/storage'.config('images.users_storage_path').$user->thumbnail) }}" alt="Author picture">
        </a>
        <h2>{{$user->name}}</h2>
    </div>
</div>

<!-- Edit profile button -->
@auth()
    @if($user->id == \Illuminate\Support\Facades\Auth::id())
        <div class="flex justify-center gap-xs">
            <a href="/user/edit">
                <button type="button" class="btn btn--primary" data-status="draft">Edit profile</button>
            </a>
        </div>
    @endif
@endauth