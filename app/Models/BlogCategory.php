<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{

    protected $table = 'blog_category';

    protected $fillable = [
        'category_id', 'blog_id'
    ];

    public $timestamps = true;
}
