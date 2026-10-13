<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordDetail extends Model
{
    protected $table = 'records_details';

    protected $guarded = [
         'id'
    ];
}
