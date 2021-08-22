<?php

namespace App;

use App\Utils\CanBeRate;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CanBeRate;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\User::class);
    }
}
