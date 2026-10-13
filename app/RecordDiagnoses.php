<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class RecordDiagnoses extends Model

{

    protected $table = 'record_diagnoses';



    protected $guarded = [

        'id'

    ];

    public function diagnose()
    {
        return $this->hasOne('App\Diagnostic', 'id', 'diagnoses_id');
    }
}
