<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class EvolutionType extends GraphQLType

{

    protected $attributes = [

        'name' => 'User',

        'description' => 'An user'

    ];



    public function fields()

    {

        return [

            'id' => [

                'type' => Type::int(),

            ],

            'date' => [

                'type' => Timestamp::type(),

            ],

            'details' => [

                'type' => Type::string(),

            ],

            
            'rejuv' => [

                'type' => Type::int(),

            ],

            'tests' => [ 
            
                'type' => Type::string()
            
            ],

            'behavior' => [ 
               
                'type' => Type::string()
            
            ],

            'process' => [ 

                'type' =>  Type::string()

            ],
            
            'mona' => [

                'type' => Type::int(),

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

