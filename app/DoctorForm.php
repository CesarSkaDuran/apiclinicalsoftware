<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class DoctorForm extends Model

{

    protected $table = 'doctors_forms';



    protected $guarded = [

        'id'

    ];
}
