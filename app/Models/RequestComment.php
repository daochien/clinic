<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestComment extends Model
{
    public $timestamps = true;

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(Attachment::class, 'request_comment_attachments', 'request_comment_id', 'attachment_id');
    }

}
