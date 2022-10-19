<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
Use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @method static find(int|string|null $id)
 * @property mixed|string $name
 * @property \Illuminate\Support\Carbon|mixed $updated_at
 * @property \Illuminate\Support\Carbon|mixed $created_at
 * @property \Illuminate\Support\Carbon|mixed $email_verified_at
 * @property mixed|string $password
 * @property mixed|string $email
 * @property mixed $medium
 * @property mixed $thumbnail
 * @property mixed|string $remember_token
 * @property array|mixed|string|string[]|null $cover_original
 * @property array|mixed|string|string[]|null $cover_medium
 * @property array|mixed|string|string[]|null $cover_thumbnail
 * @property mixed|string $username
 * @property mixed $id
 * @property mixed|string $status
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @var mixed
     */

    public function setPasswordAttribute($password)
    {
	    $this->attributes['password'] = Hash::make($password);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function comments()
    {
        return $this->hasMany(comment::class);
    }

    /**
     * Check if the user has a role
     * @param string $role
     * @return bool
     */
    public function hasAnyRole(string $role)
        {
        return null !== $this->roles()->where('name', $role)->first();
        }

    /**
     * Check if the user has a role
     * @param string $role
     * @return bool
     */
    public function hasAnyRoles(array $role)
        {
        return null !== $this->roles()->whereIn('name', $role)->first();
        }

    public function theme(){
        return $this->theme ?? config('app.default_theme');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function getAvatar($show_cross = false, $svg_size = ['width' => 25, 'height' => 25], $class_array = []){
        $exist_in_storage = false;

        if($this->thumbnail != ''){
            // Checking avatar in storage;
            $exist_in_storage = Storage::exists('/public'.config('images.users_storage_path').$this->thumbnail);
        }

        if($exist_in_storage){
            $content = '<img class="'.implode(' ', $class_array).'" src="'. url('/storage'.config('images.users_storage_path').$this->thumbnail).'" alt="User avatar">';
        }   else{
            // Add SVG;
            $content = '<svg xmlns="http://www.w3.org/2000/svg" class="avatar" width="'.$svg_size['width'].'" height="'.$svg_size['height'].'" viewBox="0 0 25 25">
                            <title>account</title>
                            <g class="icon__group" stroke-width="2" fill="currentColor" stroke="currentColor">
                            <path d="M14.08 4.97c0 2.29-1.85 5.81-4.15 5.8s-4.14-3.52-4.14-5.8a4.14 4.14 0 0 1 8.29 0z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.69 11.6a9.11 9.11 0 0 0-2.65 4.68 15.7 15.7 0 0 0 17.79 0 9.11 9.11 0 0 0-2.64-4.68" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            '.($show_cross ? '<path d="M4.222 4.222l15.556 15.556" /><path d="M19.778 4.222L4.222 19.778" />' : '').'
                            </g>
                         </svg>';
            /*
            $content = '<svg xmlns="http://www.w3.org/2000/svg" class="avatar" width="'.$svg_size['width'].'" height="'.$svg_size['height'].'" viewBox="0 0 25 25">
                            <title>face-man</title>
                            <g class="icon__group" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(0.5 0.5)" fill="currentColor" stroke="currentColor">
                                <path fill="none" stroke-miterlimit="10"
                                      d="M1.051,10.933 C4.239,6.683,9.875,11.542,16,6c3,4.75,6.955,4.996,6.955,4.996"></path>
                                <circle data-stroke="none" fill="currentColor" cx="7.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                        stroke-linecap="square" stroke="none"></circle>
                                <circle data-stroke="none" fill="currentColor" cx="16.5" cy="14.5" r="1.5" stroke-linejoin="miter"
                                        stroke-linecap="square" stroke="none"></circle>
                                <circle fill="none" stroke="currentColor" stroke-miterlimit="10" cx="12" cy="12" r="11"></circle>
                                '.($show_cross ? '<path d="M4.222 4.222l15.556 15.556" /><path d="M19.778 4.222L4.222 19.778" />' : '').'
                            </g>
                        </svg>';
            */
        }

        return (object)[
            'in_storage' => $exist_in_storage,
            'content' => $content
        ];
    }

    public function getFollowingList($limit = 20){
        $data = static::leftJoin('follows', 'follows.follow_user_id', '=', 'users.id')
            ->where('follows.user_id', $this->id)
            ->select('users.*')
            ->limit($limit)
            ->get();

        foreach($data as $item){
            $item->followed = true;
        }

        if(!Auth::guest() && Auth::id() != $this->id){
            $other_user_data = static::leftJoin('follows', 'follows.follow_user_id', '=', 'users.id')
                ->where('follows.user_id', Auth::id())
                ->select('users.*')
                ->limit($limit)
                ->get();

            $other_user_data_array = [];
            foreach($other_user_data as $item){
                $other_user_data_array[] = $item->id;
            }

            foreach($data as $item){
                $item->followed = in_array($item->id, $other_user_data_array);
            }
        }

        return $data;
    }

    public function getFollowersList($limit = 20){
        $data = static::leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.follow_user_id', $this->id)
            ->select('users.*')
            ->limit($limit)
            ->get();

        $followings = $this->getFollowingList();
        $followings_array = [];

        foreach($followings as $following){
            $followings_array[] = $following->id;
        }

        foreach($data as $item){
            $item->followed = in_array($item->id, $followings_array);
        }

        return $data;
    }

    public function followersBroadcast($title, $content, $url, $post_id){
        $followers = static::leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.follow_user_id', $this->id)
            ->select('users.*')
            ->get();

        // This is method will be better if we have user "jobs" in Laravel;
        foreach($followers as $follower){
            if(Auth::id() != $follower->id){
                Notification::send($follower->id, Auth::id(), $title, $content, $url, $post_id);
            }
        }
    }

    public static function getRecommendedUsers(){
        $users = static::limit(10)
            ->leftJoin(DB::raw("(
                select user_id, count(*) as posts_count
                        from posts
                        where status = 'published'
                        and user_id != ".Auth::id()."
                        group by user_id
            ) as posts"), 'posts.user_id', '=', 'users.id')
            ->leftJoin(DB::raw("(
                select follow_user_id
                from follows
                where user_id = ".Auth::id()."
                and follow_user_id is not null
            ) as follows"), 'follows.follow_user_id', '=', 'users.id')
            ->orderBy('posts_count', 'DESC')
            ->where('posts_count', '>', 0)
            ->select('users.*', 'follow_user_id', 'posts_count')
            ->get();

        return $users;
    }

    public static function getList($target){
        if($target == 'admin'){
            $users = static::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->where('role_id', 1)
                ->select('users.*')
                ->get();
        }   else{
            $users = static::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->whereNull('role_id')
                ->select('users.*')
                ->get();
        }
        return $users;
    }

    public function dropWithContent(){
        // Updating all user posts;
        Post::where('user_id', $this->id)
            ->update([
                'user_id' => null
            ]);

        // Updating all user comments;
        Comment::where('user_id', $this->id)
            ->delete();

        // Follows;
        Follow::where('user_id', $this->id)
            ->orWhere('follow_user_id', $this->id)
            ->delete();

        // Notifications;
        Notification::where('user_id', $this->id)
            ->orWhere('init_user_id', $this->id)
            ->delete();

        // Favorite;
        Favorite::where('user_id', $this->id)
            ->delete();

        // Likes;
        Like::where('user_id', $this->id)
            ->delete();

        // Views;
        DB::table('posts_views')
            ->where('viewer_id', $this->id)
            ->delete();

        // And then - remove the user;
        User::destroy($this->id);
    }

    public static function getCounters(){
        $counters = static::groupBy('status')
            ->selectRaw('status, count(*) as value')
            ->get();

        $result = [];
        $total = 0;
        foreach($counters as $counter){
            $result[$counter->status] = $counter->value;
            $total += $counter->value;
        }

        $counters_status_list = [
            'active', 'suspended', 'trash', 'total'
        ];


        foreach($counters_status_list as $status){
            if(!isset($result[$status])){
                $result[$status] = $status != 'total' ? 0 : $total;
            }
        }

        return $result;
    }

    public static function getUserContests(){
        return Follow::where('follows.user_id', Auth::id())
            ->whereNotNull('follow_contest_id')
            ->leftJoin('contests', 'contests.id', '=', 'follow_contest_id')
            ->where('contests.status', 'open')
            ->select('contests.*')
            ->get();
    }
}
