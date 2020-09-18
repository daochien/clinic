<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    public $timestamps = true;

    protected $hidden = ['created_at', 'updated_at' ];

    const STATUS = ['open' => 1, 'close' => 2];

    protected $guarded = [];

    protected $table = 'inquiry';

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function closedBy()
    {
        return $this->belongsToMany(User::class, 'inquiry_logs', 'inquiry_id', 'user_id');
    }

    public function inquiryComments()
    {
        return $this->hasMany(InquiryComment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function allCategory()
    {
        return Category::from('categories as c')
            ->where('c.type', Category::TYPE['inquiry'])
            ->get();
    }
}
