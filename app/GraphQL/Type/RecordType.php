<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class RecordType extends GraphQLType

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

            'identification' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'motive' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],
            'current_illness' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'conclusion' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'status' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],

            'patient' => [

                'type' => GraphQL::type('patient'),

                'description' => 'The user basic info',

            ],

            'details' => [

                'type' => GraphQL::type('recordDetail'),

                'description' => 'The user basic info',

            ],

            'physical' => [

                'type' => GraphQL::type('recordPhysical'),

                'description' => 'The user basic info',

            ],
            'resumen' => [

                'type' => GraphQL::type('resumenHistoria'),

                'description' => 'The user basic info',

            ],
            'evolutions' => [

                'type' => Type::listOf(GraphQL::type('evolution')),

                'description' => 'The user basic info',

            ],
            'examen' => [

                'type' => Type::listOf( GraphQL::type('examenes')),

                'description' => 'The user basic info',

            ],
            'nuevo_control' => [

                'type' => Type::listOf(GraphQL::type('nuevoControl')),

                'description' => 'The user basic info',

            ],

            'observations' => [

                'type' => GraphQL::type('observation'),

                'description' => 'The user basic info',

            ],

            'pregnancies' => [

                'type' => Type::listOf(GraphQL::type('pregnancy')),

                'description' => 'The user basic info',

            ],

            'citologies' => [

                'type' => Type::listOf(GraphQL::type('citology')),

                'description' => 'The user basic info',

            ],

            'coombs' => [

                'type' => Type::listOf(GraphQL::type('coomb')),

                'description' => 'The user basic info',

            ],

            'htos' => [

                'type' => Type::listOf(GraphQL::type('hto')),

                'description' => 'The user basic info',

            ],

            'hbs' => [

                'type' => Type::listOf(GraphQL::type('hb')),

                'description' => 'The user basic info',

            ],

            'cits' => [

                'type' => Type::listOf(GraphQL::type('cit')),

                'description' => 'The user basic info',

            ],

            'vaccines' => [

                'type' => Type::listOf(GraphQL::type('vaccine')),

                'description' => 'The user basic info',

            ],
            'medicines' => [

                'type' => Type::listOf(GraphQL::type('recordMedicine')),

                'description' => 'The user basic info',

            ],
            'procedures' => [

                'type' => Type::listOf(GraphQL::type('recordProcedure')),

                'description' => 'The user basic info',

            ],
            'diagnoses' => [

                'type' => Type::listOf(GraphQL::type('recordDiagnoses')),

                'description' => 'The user basic info',

            ],

            'odontograma' => [

                'type' => Type::listOf(GraphQL::type('odontograma')),

                'description' => 'The user basic info',

            ],

            'laboratory' => [

                'type' => GraphQL::type('laboratory'),

                'description' => 'The user basic info',

            ],

            'popq' => [

                'type' => GraphQL::type('popq'),

                'description' => 'The user basic info',

            ],

            'birth' => [

                'type' => GraphQL::type('birth'),

                'description' => 'The user basic info',

            ],

            'labor' => [

                'type' => GraphQL::type('labor'),

                'description' => 'The user basic info',

            ],

            'conclusion' => [

                'type' => GraphQL::type('conclusion'),

                'description' => 'The user basic info',

            ],

            'multimedias' => [

                'type' => Type::listOf(GraphQL::type('multimedia')),

                'description' => 'The user basic info',

            ],
            'user' => [

                'type' => GraphQL::type('user'),

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

