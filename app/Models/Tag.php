<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $id
 * @property mixed $category_id
 * @property mixed $medium
 * @property mixed $thumbnail
 * @property mixed $name
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug' ,'user_id'];

    public function posts()
    {
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->where('tag_id', $this->id)
            ->select('posts.*');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return TagsCategories::find($this->category_id);
    }

    public function useCount(){
        return DB::table('post_tag')
            ->where('tag_id', $this->id)
            ->count();
    }

    public function removeTagImages(){
        $path = '/public'.config('images.tags_storage_path');

        Storage::delete($path.$this->original['original']);
        Storage::delete($path.$this->medium);
        Storage::delete($path.$this->thumbnail);
    }
}
