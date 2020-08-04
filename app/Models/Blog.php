<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'owner_id', 'draft', 'title', 'content', 'image'
    ];

    public $timestamps = true;

    public function categorys()
    {
        return $this->belongsToMany(Category::class);
    }

}
