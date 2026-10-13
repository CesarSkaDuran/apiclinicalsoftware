<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Appointment extends Model

{

    protected $table = 'appointments';



    protected $guarded = [

         'id'

    ];

    public function doctorRemision()
    {
        return $this->hasOne('App\DrRemision', 'id' ,'remision_id', );
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor', 'user_id', 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'id');
    }

}

