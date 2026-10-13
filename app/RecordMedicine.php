<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class RecordMedicine extends Model

{

    protected $table = 'record_medicines';



    protected $guarded = [

        'id'

    ];
    
    public function medicine()
    {
        return $this->hasOne('App\Medicine', 'id', 'medicine_id');
    }
}