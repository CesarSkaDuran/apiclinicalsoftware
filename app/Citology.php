<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citology extends Model
{
    protected $table = 'citologies';

    protected $guarded = [
         'id'
    ];
}
