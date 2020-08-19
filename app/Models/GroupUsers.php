<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    protected $fillable = ['user_id', 'group_id'];
    public function user()
    {
        return $this->hasMany(Users::class);
    }
}
