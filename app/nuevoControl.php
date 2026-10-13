<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NuevoControl extends Model
{
    protected $table = 'nuevo_control';

    protected $guarded = [
        'id'
    ];
}
