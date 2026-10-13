<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedimientoPaciente extends Model
{
    protected $table = 'procedimiento_paciente';

    protected $guarded = [
        'id'
    ];

}
