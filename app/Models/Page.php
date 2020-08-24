<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'owner_id', 'type', 'title', 'content', 'image', 'release', 'release_date', 'public', 'public_destination', 'files', 'category_id'
    ];

    public $timestamps = true;

    public function categorys()
    {
        return $this->belongsTo(Category::class);
    }
}
