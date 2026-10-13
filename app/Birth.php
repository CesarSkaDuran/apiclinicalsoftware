<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Birth extends Model
{
    protected $table = 'births';

    protected $guarded = [
         'id'
    ];
}
