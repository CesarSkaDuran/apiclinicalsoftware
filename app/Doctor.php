<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $guarded = [
         'id'
    ];

    public function schedulle()
    {
        return $this->hasOne('App\DoctorSchedulle', 'doctor_id', 'id');
    }
    public function accounts()
    {
        return $this->hasOne('App\PaymentInfo', 'user_id', 'user_id');
    }
}
