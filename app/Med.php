<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Med extends Model
{
    protected $table = 'meds';

    protected $guarded = [
        'id'
    ];
}
