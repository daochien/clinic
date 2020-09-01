<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class NotificationStatus extends Model
{
    protected $table = 'notification_status';

    const STATUS = [
        'unread' => 1,
        'read' => 2,
    ];

    protected $fillable = [
        'notification_id', 'user_id', 'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }
}
