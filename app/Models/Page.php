<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'owner_id', 'type', 'title', 'content', 'image', 'public', 'public_date', 'status', 'url', 'files', 'category_id'
    ];

    public $timestamps = true;

    public function categorys()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'page_group', 'page_id', 'group_id')->select('name', 'id');
    }
}
