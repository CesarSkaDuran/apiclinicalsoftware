<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppPatient extends Model
{
    protected $table = 'app_patients';

    protected $guarded = [
         'id'
    ];
    public function User()
    {
        return $this->belongsTo('App\user', 'user_id', 'id');
    }
}
