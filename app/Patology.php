<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Patology extends Model

{

    protected $table = 'patologies';



    protected $guarded = [

        'id'

    ];
}
