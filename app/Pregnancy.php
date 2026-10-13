<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregnancy extends Model
{
    protected $table = 'pregnancies';

    protected $guarded = [
         'id'
    ];
}
