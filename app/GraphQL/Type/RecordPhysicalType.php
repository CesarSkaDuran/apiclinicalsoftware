<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class RecordPhysicalType extends GraphQLType

{

    protected $attributes = [

        'name' => 'User',

        'description' => 'An user'

    ];



    public function fields()

    {

        return [

            'id' => [

                'type' => Type::id(),

            ],


            'snc' => [

                'type' => Type::string(),

            ],

            'gluteos' => [

                'type' => Type::string(),

            ],

            'geni' => [

                'type' => Type::string(),

            ],


            'physical_ta' => [

                'type' => Type::string(),

            ],

            'physical_fc' => [

                'type' => Type::string(),

            ],

            'weight' => [

                'type' => Type::string(),

            ],

            'height' => [

                'type' => Type::string(),

            ],
            'imc' => [

                'type' => Type::string(),

            ],
            'otros' => [

                'type' => Type::string(),

            ],

            'spo2' => [

                'type' => Type::string(),

            ],
            'ta' => [

                'type' => Type::string(),

            ],

            'head' => [

                'type' => Type::string(),

            ],

            'neck' => [

                'type' => Type::string(),

            ],

            'thorax' => [

                'type' => Type::string(),

            ],

            'pregnancy' => [

                'type' => Type::string(),

            ],
            'exams' => [

                'type' => Type::string(),

            ],

            'sao' => [
                'type' => Type::string(),
            ],

            'temperature' => [
                'type' => Type::string(),
            ],

            'tension' => [
                'type' => Type::string(),
            ],

            'mental' => [
                'type' => Type::string(),
            ],

            'skin' => [
                'type' => Type::string(),
            ],

            'pulm' => [
                'type' => Type::string(),
            ],

            'abdomen' => [
                'type' => Type::string(),
            ],

            'extremities' => [
                'type' => Type::string(),
            ],

            'neurol' => [
                'type' => Type::string(),
            ],


            'created_at' => [

                'type' => Timestamp::type(),

                'description' => 'The email of user'

            ],

            'updated_at' => [

                'type' => Timestamp::type(),

                'description' => 'The email of user'

            ]

        ];

    }

}































