<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NotificationGroup;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','postal_code','address'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function notificationGroups()
    {
        return $this->hasMany(NotificationGroup::class, 'group_id', 'id');
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupUser::class, 'group_id', 'id');
    }

    public function group_users()
    {
        return $this->hasMany(GroupUsers::class,'group_id');
    }
}
