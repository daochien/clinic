<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Models\GroupUser;

class User extends Authenticatable // implements MustVerifyEmail
{

    CONST ROOT_EMAIL_ADMIN = [
        'admin@gmail.com'
    ];

    public $timestamps = true;

    const USER_ROLE = ['staff_web' => 3, 'staff_mobile' => 4];

    const ADMIN_ID = [1, 2];

    use Notifiable, HasApiTokens, HasRoles;

    //protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'note', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->roles()->whereIn('id', self::ADMIN_ID)->exists();
    }

    public function isUser()
    {
        return $this->roles()->whereIn('id', array_values(self::USER_ROLE))->exists();
    }

    public function clinicUsers()
    {
        return $this->hasMany(ClinicUser::class);
    }

    public function groupUsers()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function inquiryUsers()
    {
        return $this->hasMany(InquiryUser::class);
    }

    public function levelUsers()
    {
        return $this->hasOne(LevelUser::class);
    }

    public function notificationUsers()
    {
        return $this->hasMany(NotificationUser::class);
    }

    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class);
    }

    public function typeUsers()
    {
        return $this->hasMany(TypeUser::class);
    }

     public function role()
     {
         return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
     }

    public function type()
    {
        return $this->belongsToMany(Type::class, 'type_users', 'user_id', 'type_id');
    }

    public function level()
    {
        return $this->belongsToMany(Level::class, 'level_users', 'user_id', 'level_id');
    }

    public function group()
    {
        return $this->belongsToMany(Group::class, 'group_users', 'user_id', 'group_id');
    }

    public function clinic()
    {
        return $this->belongsToMany(Clinic::class, 'clinic_users', 'user_id', 'clinic_id');
    }

    public function loginLog()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (self $clinic): void {
            $clinic->clinicUsers()->delete();
            $clinic->groupUsers()->delete();
            $clinic->inquiryUsers()->delete();
            $clinic->levelUsers()->delete();
            $clinic->notificationUsers()->delete();
            $clinic->roleUsers()->delete();
            $clinic->typeUsers()->delete();
        });
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users', 'user_id');
    }

    public function getRoles()
    {
        return $this->belongsToMany(Role::class)->select('roles.id', 'name');
    }
    public function isRoot()
    {
        if (in_array($this->email, self::ROOT_EMAIL_ADMIN)) {
            return true;
        }

        $role = Role::find(Role::ROLE_DEFAULT['root']);

        if ($this->hasRole($role->name)) {
            return true;
        }

        return false;
    }
}
