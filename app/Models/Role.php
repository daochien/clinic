<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'roles';

    const USER_ROLE = ['Web' => 3, 'Mobile' => 4];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
