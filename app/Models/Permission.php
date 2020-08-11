<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'guard_name'
    ];

    protected $table = 'permissions';

    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
