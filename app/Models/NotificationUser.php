<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = 'notification_users';

    protected $fillable = [
        'notification_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function status()
    {
        return $this->hasMany(NotificationStatus::class, 'notification_user_id', 'id');
    }
}
