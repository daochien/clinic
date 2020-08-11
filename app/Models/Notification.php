<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GroupUser;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'confirm', 'draft'
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
        return $this->belongsToMany(GroupUser::class, 'notification_groups', 'group_id', 'id');
    }
}
