<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaCobro extends Model
{
    protected $table = 'cuenta_cobro';

    protected $guarded = ['id'];
    
    // public function empresaCuenta()
    // {
    //     return $this->hasOne('App\Empresa',  'afiliacion_id', 'id_afiliacion');
    // }

    // public function sucursal()
    // {
    //     return $this->hasOne('App\Sucursal',  'id', 'sucursal_id');
    // }
    public function tercero()
    {
        return $this->hasOne('App\Tercero',  'id', 'tercero_id');
    }
}
