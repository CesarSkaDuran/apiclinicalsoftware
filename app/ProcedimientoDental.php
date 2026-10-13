<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedimientoDental extends Model
{
    protected $table = 'procedimiento_dental';

    protected $guarded = [
        'id'
    ];
    
    public function categoria()
    {
        return $this->hasOne('App\Categoria', 'id', 'categoria_id');
    }
}
