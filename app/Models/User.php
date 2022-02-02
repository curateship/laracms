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
}
