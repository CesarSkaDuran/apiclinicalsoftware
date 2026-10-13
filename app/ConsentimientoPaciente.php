<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsentimientoPaciente extends Model
{
    protected $table = 'consentimiento_pacientes';

    protected $guarded = [

        'id'

    ];

    public function doctor()
    {
        return $this->hasOne('App\DrRemision', 'id', 'doctor_id');
    }
}
