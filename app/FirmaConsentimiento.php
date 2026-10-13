<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaConsentimiento extends Model
{
    protected $table = 'firmas_consentimientos';

    protected $guarded = [
        'id'
    ];
}
