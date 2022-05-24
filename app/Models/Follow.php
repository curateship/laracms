<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed|string|null $user_id
 * @property array|mixed|string|null $follow_user_id
 */
class Follow extends Model
{
    use HasFactory;
}
