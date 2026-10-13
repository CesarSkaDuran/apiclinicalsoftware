<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consentimiento extends Model
{

    protected $table = 'consentimiento';

    protected $guarded = [

        'id'

    ];
   
    public function doctor()
    {
        return $this->hasOne('App\DrRemision', 'id', 'doctor_id');
    }

}
