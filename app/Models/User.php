<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
}
