<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $guarded = [
         'id'
    ];

    /**
    * 
    */
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'identification');
    }

    public function details()
    {
        return $this->hasOne('App\RecordDetail', 'record_id', 'identification');
    }

    public function resumen()
    {
        return $this->hasOne('App\ResumenHistoria', 'record_id', 'identification');
    }

    public function physical()
    {
        return $this->hasOne('App\RecordPhysical', 'record_id', 'identification');
    }

    public function evolutions()
    {
        return $this->hasMany('App\Evolution', 'record_id', 'identification')->orderBy('date', 'desc');
    }
    public function nuevo_control()
    {
        return $this->hasMany('App\NuevoControl', 'identification', 'identification')->orderBy('date', 'desc');
    }
    public function observations()
    {
        return $this->hasOne('App\Obs', 'record_id', 'identification');
    }

    public function pregnancies()
    {
        return $this->hasMany('App\Pregnancy', 'record_id', 'identification');
    }

    public function citologies()
    {
        return $this->hasMany('App\Citology', 'record_id', 'identification');
    }

    public function coombs()
    {
        return $this->hasMany('App\Coomb', 'record_id', 'identification');
    }

    public function htos()
    {
        return $this->hasMany('App\Hto', 'record_id', 'identification');
    }

    public function hbs()
    {
        return $this->hasMany('App\Hb', 'record_id', 'identification');
    }

    public function cits()
    {
        return $this->hasMany('App\Cit', 'record_id', 'identification');
    }

    public function vaccines()
    {
        return $this->hasMany('App\Vaccine', 'record_id', 'identification');
    }
    
    public function medicines()
    {
        return $this->hasMany('App\RecordMedicine', 'record_id', 'identification');
    }
    public function procedures()
    {
        return $this->hasMany('App\RecordProcedure', 'record_id', 'identification');
    }
    public function diagnoses()
    {
        return $this->hasMany('App\RecordDiagnoses', 'record_id', 'identification');
    }
    public function examen()
    {
        return $this->hasMany('App\Examen', 'record_id', 'identification');
    }
    public function laboratory()
    {
        return $this->hasOne('App\Laboratory', 'record_id', 'identification');
    }

    public function labor()
    {
        return $this->hasOne('App\Labor', 'record_id', 'identification');
    }

    public function birth()
    {
        return $this->hasOne('App\Birth', 'record_id', 'identification');
    }

    public function conclusion()
    {
        return $this->hasOne('App\Conclusion', 'record_id', 'identification');
    }

    public function popq()
    {
        return $this->hasOne('App\Popq', 'record_id', 'identification');
    }

    public function multimedias()
    {
        return $this->hasMany('App\Multimedia', 'record_id', 'identification');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function planTratamiento()
    {
        return $this->hasOne('App\PlanTratamiento', 'record_id', 'identification');
    }
    public function odontograma()
    {
        return $this->hasMany('App\Odontograma', 'record_id', 'identification');
    }
}
