<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
Use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

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
        }

        return (object)[
            'in_storage' => $exist_in_storage,
            'content' => $content
        ];
    }

    public function getFollowList($limit = 20){
        return static::leftJoin('follows', 'follows.follow_user_id', '=', 'users.id')
            ->where('follows.user_id', $this->id)
            ->select('users.*')
            ->limit($limit)
            ->get();
    }

    public function followersBroadcast($title, $content, $url){
        $followers = static::leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.follow_user_id', $this->id)
            ->select('users.*')
            ->get();

        // This is method will be better if we have user "jobs" in Laravel;
        foreach($followers as $follower){
            Notification::send($follower->id, Auth::id(), $title, $content, $url);
        }
    }
}
