<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class ResumenHistoriaType extends GraphQLType

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

                'description' => 'The id of the user'

            ],

            'record_id' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'esqueletico' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],
            'dental' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'funcional' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'estetico' => [

                'type' => Type::string(),

                'description' => 'The status of user'

            ],


            'periodontal' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],
            'estetica_facial' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'estetica_dental' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'oclusion_funcional' => [

                'type' => Type::string(),

                'description' => 'The status of user'

            ],


            'esqueletico' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],
            'atm' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'periodoncia' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'requerimiento_paciente' => [

                'type' => Type::string(),

                'description' => 'The status of user'

            ],


            'plan_tratamiento' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'limitacion' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'pronostico' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'interconsultas' => [

                'type' => Type::string(),

                'description' => 'The status of user'

            ],

            'radiografias' => [

                'type' => Type::string(),

                'description' => 'The status of user'

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
