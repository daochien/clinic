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
}
