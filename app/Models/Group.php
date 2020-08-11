<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description','postal_code','address'];
    public function group_users()
    {
        return $this->hasMany(GroupUsers::class,'group_id');
    }
}
