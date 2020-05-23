<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'content', 'tags'];

    public function toArray()
    {
        return [
            'title' => $this->title,
            'tags' => $this->tags
        ];
    }
}
