<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hto extends Model
{
    protected $table = 'htos';

    protected $guarded = [
         'id'
    ];
}
