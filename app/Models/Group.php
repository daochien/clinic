<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'forced'];


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

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_groups', 'group_id');
    }

    public function group_users()
    {
        return $this->hasMany(GroupUser::class,'group_id');
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupUser::class,'group_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users', 'user_id');
    }


    public function usersCount()
    {
        return $this->hasMany(GroupUser::class)->count();
    }

}
