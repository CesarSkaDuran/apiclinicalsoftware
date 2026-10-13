<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporal extends Model
{
    protected $table = 'temporal';

    protected $guarded = ['id'];

    public function empresa()
    {
        return $this->hasOne('App\Tercero',  'id', 'id_empresa');
    }
    // public function sucursal()
    // {
    //     return $this->hasOne('App\Sucursal',  'id', 'sucursal_id');
    // }
}
