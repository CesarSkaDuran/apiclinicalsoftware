<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popq extends Model
{
    protected $table = 'popqs';

    protected $guarded = [
         'id'
    ];
}
