<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria_dental';

    protected $guarded = [
        'id'
    ];

    public function procedimiento()
    {
        return $this->hasMany('App\ProcedimientoDental', 'categoria_id', 'id');
    }
}
