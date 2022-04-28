<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $scraper_id
 * @property mixed|string $item_url
 * @property array|\Illuminate\Contracts\Foundation\Application|Request|mixed|string|null $list_page_url
 */
class ScraperStat extends Model
{
    use HasFactory;
}
