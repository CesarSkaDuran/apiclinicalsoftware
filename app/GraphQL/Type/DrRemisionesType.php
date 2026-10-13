<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class DrRemisionesType extends GraphQLType

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

            'user_id' => [

                'type' => Type::int(),

            ],

            'nombre' => [

                'type' => Type::string(),

            ],

            'especializacion' => [

                'type' => Type::string(),

            ],
            
            'telefono' => [

                'type' => Type::string(),

            ],

            'direccion' => [

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
