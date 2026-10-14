<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RipsReport extends Model
{
    protected $hidden = ['payload'];

    protected $fillable = [
        'owner_user_id',
        'num_documento_id_obligado',
        'num_nota',
        'payload',
    ];
}
