<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RipsProviderConfig extends Model
{
    protected $fillable = [
        'owner_user_id',
        'num_documento_id_obligado',
        'cod_prestador',
        'next_num_nota',
    ];
}
