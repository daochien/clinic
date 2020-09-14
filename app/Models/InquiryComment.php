<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryComment extends Model
{
    public $timestamps = true;

    protected $hidden = ['created_at', 'updated_at' ];

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(Attachment::class, 'inquiry_comment_attachments', 'inquiry_comment_id', 'attachment_id');
    }
}
