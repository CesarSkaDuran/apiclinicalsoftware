<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $table = 'controls';

    protected $guarded = [
         'id'
    ];
}
