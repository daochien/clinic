<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description', 'type'];

    const TYPE = ['document' => 1,'blog' => 2, 'inquiry' => 3, 'template' => 4, 'faq' => 5];

    protected $hidden = ['created_at', 'updated_at'];

    public function inquiry()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function latestPage()
    {
        return $this->hasOne(Page::class, 'category_id')->latest();
    }
}
