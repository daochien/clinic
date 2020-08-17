<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    public function role()
    {
        return $this->hasMany(Role::class, 'id', 'role_id');
    }
}
