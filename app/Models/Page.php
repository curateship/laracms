<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $status
 * @property mixed|string $slug
 * @property mixed $body
 * @property mixed $title
 */
class Page extends Model
{
    use HasFactory;

    public function getContent(){
        $content = Post::jsonToHtml($this->body);

        return html_entity_decode($content);
    }
}
