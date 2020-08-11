<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
use App\Models\Group;

class NotificationGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id', 'group_id'
    ];

    public function notifications()
    {
        return $this->belongsToMany(Notification::class,  'notification_groups', 'group_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class,  'groups', 'group_id', 'id');
    }
}
