<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedulle extends Model
{
    protected $table = 'doctors_schedulle';

    protected $guarded = [
        'id'
    ];
}
