<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'excerpt', 'body', 'user_id', 'category_id'];

    public function author()
    {
	    return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
	    return $this->belongsTo(User::class);
    }

    public function tags()
    {
	    return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
	    return $this->hasMany(Comment::class);
    }

    public function image()
    {
	    return $this->morphOne(Image::class, 'imageable');
    }
	
}
