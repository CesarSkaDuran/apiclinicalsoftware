<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $table = 'labors';

    protected $guarded = [
         'id'
    ];
}
