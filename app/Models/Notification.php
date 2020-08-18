<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'confirm', 'draft', 'schedule_date'
    ];

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

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'notification_groups', 'group_id');
    }

    public function notificationGroups()
    {
        return $this->hasMany(NotificationGroup::class, 'notification_id');
    }

    public function usersCount()
    {
        return $this->hasMany(NotificationUser::class)->count();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users', 'user_id');
    }

    public function usersRead()
    {
        return $this->hasMany(NotificationStatus::class)->where('status', [2, 3])->count();
    }

    public function usersConfirm()
    {
        return $this->hasMany(NotificationStatus::class)->where('status', '=', 1)->count();
    }
}
