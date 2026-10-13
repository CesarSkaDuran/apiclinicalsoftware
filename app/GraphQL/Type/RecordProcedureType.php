<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class RecordProcedureType extends GraphQLType

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

                'type' => Type::string(),

            ],
            'procedure_id' => [

                'type' => Type::int(),

            ],
            'code' => [

                'type' => Type::string(),

            ],
            'description' => [

                'type' => Type::string(),

            ],
            'procedure' => [

                'type' => GraphQL::type('procedure'),

                'description' => 'The user basic info',

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
