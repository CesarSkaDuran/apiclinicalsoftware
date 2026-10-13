<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hb extends Model
{
    protected $table = 'hbs';

    protected $guarded = [
         'id'
    ];
}
