<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property array|mixed|string|string[]|null $medium
 * @property array|mixed|string|string[]|null $thumbnail
 * @property array|mixed|string|string[]|null $original
 * @property mixed $name
 * @property int|mixed|string|null $user_id
 * @property mixed|string $slug
 */
class Favorite extends Model
{
    use HasFactory;
}
