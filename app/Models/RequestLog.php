<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    public $timestamps = true;

    public $guarded = [];

    const STATUS = ['watting' => 1, 'approved' => 2, 'rejected'  => 3];
}
