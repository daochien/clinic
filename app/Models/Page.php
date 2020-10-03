<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    CONST PAGE_TYPE = [
        'blog' => 'blog',
        'manual' => 'manual',
        'faq' => 'faq'
    ];

    CONST PAGE_STATUS = [
        'active' => 1,
        'un_active' => 0
    ];

    protected $fillable = [
        'owner_id', 'type', 'title', 'content', 'image', 'public', 'public_date', 'status', 'url', 'files', 'category_id', 'downloads', 'views', 'summary'
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
