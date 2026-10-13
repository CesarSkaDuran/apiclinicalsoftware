<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordPhysical extends Model
{
    protected $table = 'records_physical';

    protected $guarded = [
         'id'
    ];
}
