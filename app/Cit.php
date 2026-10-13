<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cit extends Model
{
    protected $table = 'cytochemicals';

    protected $guarded = [
         'id'
    ];
}
