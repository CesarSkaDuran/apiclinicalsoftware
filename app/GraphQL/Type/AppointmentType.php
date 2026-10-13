<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;

/**

 * UserType

 */

class AppointmentType extends GraphQLType

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

            'patient_id' => [

                'type' => Type::int(),

            ],

            'app_user_id' => [

                'type' => Type::int(),

            ],

            'user_id' => [

                'type' => Type::int(),

            ],

            'name' => [

                'type' => Type::string(),

            ],

            'company' => [

                'type' => Type::string(),

            ],
            'value' => [

                'type' => Type::string(),

            ],
            'date' => [

                'type' => Type::string(),

            ],
            'time' => [

                'type' => Type::string(),

            ],

            'end_time' => [

                'type' => Type::string(),

            ],

            'phone_confirmation' => [

                'type' => Type::string(),

            ],

            'email_confirmation' => [

                'type' => Type::string(),

            ],


            'type' => [

                'type' => Type::int(),

            ],

            'payment_type' => [

                'type' => Type::int(),

            ],

            'status' => [

                'type' => Type::int(),

            ],
            'total' => [

                'type' => Type::int(),

            ],
            'reason' => [

                'type' => Type::string(),

            ],

            'doctor' => [

                'type' => GraphQL::type('doctor'),

                'description' => 'The user basic info',

            ],

            'doctorRemision' => [

                'type' => GraphQL::type('drRemisiones'),

                'description' => 'The user basic info',

            ],

            'patient' => [

                'type' => GraphQL::type('patient'),

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

