<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class MedicineType extends GraphQLType

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

            'name' => [

                'type' => Type::string(),

            ],
            'presentation' => [

                'type' => Type::string(),

            ],
            'atc_code' => [

                'type' => Type::string(),

            ],
            'active' => [

                'type' => Type::string(),

            ],
            'administration' => [

                'type' => Type::string(),

            ],
            'pos' => [

                'type' => Type::string(),

            ],
            'cum' => [

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
