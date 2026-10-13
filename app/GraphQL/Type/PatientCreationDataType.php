<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class PatientCreationDataType extends GraphQLType

{

    protected $attributes = [

        'name' => 'User',

        'description' => 'An user'

    ];



    public function fields()

    {

        return [
            'arls' => [

                'type' => Type::listOf(GraphQL::type('arl')),

                'description' => 'The user basic info',

            ],
            'epss' => [

                'type' => Type::listOf(GraphQL::type('eps')),

                'description' => 'The user basic info',

            ],
            'pensions' => [

                'type' => Type::listOf(GraphQL::type('pension')),

                'description' => 'The user basic info',

            ],
        ];
    }
}
