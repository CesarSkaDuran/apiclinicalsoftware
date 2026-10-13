<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleGasto extends Model
{
    protected $table = 'detalle_gastos';

    protected $guarded = ['id'];
}
