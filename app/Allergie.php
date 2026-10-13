<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Allergie extends Model

{

    protected $table = 'allergies';



    protected $guarded = [

        'id'

    ];
}
