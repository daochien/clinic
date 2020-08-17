<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicUser extends Model
{

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function clinics()
    {
        return $this->hasMany(Clinic::class, 'id', 'clinic_id');
    }
}
