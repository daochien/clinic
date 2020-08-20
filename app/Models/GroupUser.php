<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;


class GroupUser extends Model
{
    protected $fillable = ['user_id', 'group_id'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }


}
