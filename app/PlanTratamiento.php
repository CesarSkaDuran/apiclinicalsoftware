<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanTratamiento extends Model
{
    protected $table = 'plan_tratamiento';

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

