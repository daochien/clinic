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
        return $this->hasMany(ClinicUser::class)->with('users');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (self $clinic): void {
            $clinic->clinicUsers()->delete();
        });
    }
}
