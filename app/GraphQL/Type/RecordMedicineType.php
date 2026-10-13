<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class RecordMedicineType extends GraphQLType

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

            'record_id' => [

                'type' => Type::int(),

            ],
            'medicine_id' => [

                'type' => Type::int(),

            ],
            'medicine' => [

                'type' => GraphQL::type('medicine'),

                'description' => 'The user basic info',

            ],
            'dose' => [

                'type' => Type::string(),

            ],
            'measure' => [

                'type' => Type::string(),

            ],
            'frequency' => [

                'type' => Type::string(),

            ],
            'duration' => [

                'type' => Type::string(),

            ],
            'quantity' => [

                'type' => Type::string(),

            ],
            'administration' => [

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