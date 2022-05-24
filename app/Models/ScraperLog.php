<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $scraper_id
 * @property mixed $url
 * @property mixed $page_url
 */
class ScraperLog extends Model
{
    use HasFactory;
}
