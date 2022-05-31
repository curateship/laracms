<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;

/**
 * @property mixed|string $slug
 * @property mixed|string $name
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug' ,'user_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
