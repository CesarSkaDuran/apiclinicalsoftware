<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrRemision extends Model
{
    protected $table = 'dr_remisiones';

    protected $guarded = [
        'id'
    ];
}
