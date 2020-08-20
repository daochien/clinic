<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{

    CONST ROLE_DEFAULT = [
        'root' => 1,
        'admin' => 2,
        'web' => 3,
        'mobile' => 4
    ];

    protected $fillable = [
        'name', 'description'
    ];

    protected $table = 'roles';

    const ROLE_USER_DEFAULT = 'User';

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
