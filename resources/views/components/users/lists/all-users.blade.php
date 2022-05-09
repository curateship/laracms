<div class="margin-bottom-md">
    <ul class="flex flex-wrap gap-xxs">
         @foreach($users as $user)
             <a class="link-subtle" href="/user/{{$user->id}}">
                 <li>
                     <span class="chip text-sm">
                         @if($user->thumbnail != '')
                             <img class="chip__img" src="{{url('/storage'.config('images.users_storage_path').$user->thumbnail)}}" alt="tag-icon">
                         @endif
                       <i class="chip__label">{{$user->name}}</i>
                     </span>
                 </li>
             </a>
         @endforeach
    </ul>
</div>