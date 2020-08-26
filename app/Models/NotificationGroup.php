<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
use App\Models\Group;

class NotificationGroup extends Model
{
    protected $table = 'notification_groups';

    public $timestamps = false;

    protected $fillable = [
        'notification_id', 'group_id'
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
