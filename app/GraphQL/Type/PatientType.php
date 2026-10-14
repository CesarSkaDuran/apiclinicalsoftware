<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;

use App\NotificationLog;

use Carbon\Carbon;



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

            'birthdayNotification' => [

                'type' => Type::string(),

                'description' => 'Estado de la notificacion de cumpleanos del dia: sent, failed, pending o null si no cumple hoy',

                'resolve' => function ($root) {
                    if (empty($root->birth_date)) {
                        return null;
                    }

                    try {
                        $birth = Carbon::parse($root->birth_date);
                    } catch (\Exception $e) {
                        return null;
                    }

                    $today = Carbon::now('America/Bogota');

                    if ($birth->month != $today->month || $birth->day != $today->day) {
                        return null;
                    }

                    $log = NotificationLog::where('type', 'birthday')
                        ->where('channel', 'email')
                        ->where('patient_id', $root->id)
                        ->where('reference', $today->toDateString())
                        ->orderBy('id', 'desc')
                        ->first();

                    return $log ? $log->status : 'pending';
                },

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

