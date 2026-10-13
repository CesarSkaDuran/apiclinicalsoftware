<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Diagnostic extends Model

{

    protected $table = 'diagnoses';



    protected $guarded = [

        'id'

    ];
}
