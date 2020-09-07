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
        'title', 'content', 'confirm', 'draft', 'schedule_date', 'created_by'
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
        'schedule_date' => 'datetime'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'notification_groups', 'group_id');
    }

    public function notificationGroups()
    {
        return $this->hasMany(NotificationGroup::class, 'notification_id');
    }

    public function status()
    {
        return $this->hasOne(NotificationStatus::class, 'notification_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users', 'notification_id', 'user_id');
    }

    public function usersRead()
    {
        return $this->hasMany(NotificationStatus::class)->where('status', [2, 3]);
    }

    public function usersConfirm()
    {
        return $this->hasMany(NotificationStatus::class)->where('status', '=', 1);
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
