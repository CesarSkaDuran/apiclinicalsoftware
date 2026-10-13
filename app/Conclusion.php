<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Conclusion extends Model

{

    protected $table = 'conclusions';



    protected $guarded = [

         'id'

    ];

    public function rel_diagnostic()
    {
        return $this->hasOne('App\Diagnostic', 'id', 'diagnostic');
    }

    public function rel_procedure()
    {
        return $this->hasOne('App\Procedure', 'id', 'procedure_id');
    }

}

