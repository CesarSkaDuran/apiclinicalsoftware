<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class PatientType extends GraphQLType

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

            'name' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'identification' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'position' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'imagen' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'civil_status' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'birth_date' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'phone' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'address' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'company' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'email' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'grupo_sanguineo' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],


            'partner_name' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'partner_profession' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],  

            'profile_url' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],          

            'status' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],
            'chat_id' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'eps' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],
            'sex' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],
            'fecha' => [

                'type' => Type::string(),

                'description' => 'The email of user'

            ],

            'TipoDocumento' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],
            'arl' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],


            'pension' => [

                'type' => Type::int(),

                'description' => 'The status of user'

            ],

            'records' => [

                'type' => Type::listOf(GraphQL::type('record')),

                'description' => 'The user basic info',

            ],

            'patient_eps' => [

                'type' => GraphQL::type('eps'),

                'description' => 'The user basic info',

            ],

            'patient_arl' => [

                'type' => GraphQL::type('arl'),

                'description' => 'The user basic info',

            ],

            'patient_pension' => [

                'type' => GraphQL::type('pension'),

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

