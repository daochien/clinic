<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    public $timestamps = true;

    public $guarded = [];

    const STATUS = ['approve' => 1, 'reject'  => 2];
}
