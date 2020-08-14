<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelUser extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class, 'level_users', 'level_id', 'user_id');
    }
}
