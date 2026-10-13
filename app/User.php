<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    AuthenticatableUserContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    private $DOCTOR = 2;
    private $APP_USER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'user_type', 'password', 'status', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['is_doctor'];

    public function getIsDoctorAttribute() {
        return $this->attributes['user_type'] == $this->DOCTOR;
    }

    /**
     *
     */
    public function app_patient()
    {
        return $this->hasOne('App\AppPatient', 'user_id', 'id');
    }

    /**
     *
     */
    public function doctor()
    {
        return $this->hasOne('App\Doctor', 'user_id', 'id');
    }

    /**
    *
    */
    public function info()
    {
        return $this->hasOne('App\UserInfo', 'user_id', 'id');
    }

    /**
    *
    */
    public function subscription()
    {
        return $this->hasOne('App\UserSubscription', 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
             'user' => [
                'id' => $this->id,
                'email' => $this->email,
                'state' => $this->state
             ]
        ];
    }
}
