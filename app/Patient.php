<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $guarded = [
         'id'
    ];

    // public function getCivilStatusAttribute($value)
    // {
    //     if($value == 1) return 'Soltero/a';
    //     if($value == 2) return 'Casado/a';
    //     if($value == 3) return 'Divorciado/a';
    //     if($value == 4) return 'Viudo/a';

    //     return 'Sin Datos';
    // }

    /**
    * 
    */
    public function records()
    {
        return $this->hasMany('App\Record', 'patient_id', 'identification')->orderBy('created_at', 'desc');
    }

    /**
     *
     */
    public function patient_eps()
    {
        return $this->hasOne('App\Eps', 'id', 'eps');
    }

    /**
     *
     */
    public function patient_arl()
    {
        return $this->hasOne('App\Arl', 'id', 'arl');
    }

    /**
     *
     */
    public function patient_pension()
    {
        return $this->hasOne('App\Pension', 'id', 'pension');
    }
}
