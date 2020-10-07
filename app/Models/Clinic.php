<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'post_code', 'address',
    ];

    public function clinicUsers()
    {
        return $this->hasMany(ClinicUser::class);
    }

    public function usersCount()
    {
        return $this->hasMany(ClinicUser::class)
            ->join('model_has_roles as mr', 'mr.model_id', 'clinic_users.user_id')
            ->where('mr.role_id', 3)
            ->count();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'clinic_users', 'clinic_id', 'user_id')->with(['group']);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (self $clinic): void {
            $clinic->clinicUsers()->delete();
        });
    }
}
