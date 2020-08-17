<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    public function type()
    {
        return $this->hasMany(Type::class, 'id', 'type_id');
    }
}
