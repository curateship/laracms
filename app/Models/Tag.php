<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float|int|mixed|string $name
 */
class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
