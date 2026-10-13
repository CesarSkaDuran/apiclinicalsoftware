<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class RecordProcedure extends Model

{

    protected $table = 'record_procedures';



    protected $guarded = [

        'id'

    ];

    public function procedure()
    {
        return $this->hasOne('App\Procedure', 'id', 'procedure_id');
    }
}
