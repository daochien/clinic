<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $fillable = ['user_id'];
    public function users()
    {
        return $this->belongsTo(User::class,'id', 'user_id');
    }
}
