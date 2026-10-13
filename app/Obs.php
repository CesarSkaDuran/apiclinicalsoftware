<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obs extends Model
{
    protected $table = 'observations';

    protected $guarded = [
         'id'
    ];
}
