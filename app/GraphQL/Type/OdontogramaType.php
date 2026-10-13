<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class OdontogramaType extends GraphQLType

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

            'diente_id' => [

                'type' => Type::int(),

            ],


            'corona' => [

                'type' => Type::string(),

            ],


            'corona_provisional' => [

                'type' => Type::string()

            ],

            'endodoncia' => [

                'type' => Type::string()

            ],

            'ausente' => [

                'type' =>  Type::string()

            ],


            'restauracion' => [

                'type' => Type::string(),

            ],

            'implante' => [

                'type' => Type::string(),

            ],
            'perno_munon' => [

                'type' => Type::string(),

            ],

            'otros' => [

                'type' => Type::string(),

            ],

            'protesis_removible' => [

                'type' => Type::string(),

            ],

            'amalgama' => [

                'type' => Type::string(),

            ],

            'sellante' => [

                'type' => Type::string(),

            ],

            'diente_sano' => [

                'type' => Type::string(),

            ],

            'caries' => [

                'type' => Type::string(),

            ],
            'infeccion_pulpar' => [

                'type' => Type::string(),

            ],
            'fractura' => [

                'type' => Type::string(),

            ],
            'movilidad' => [

                'type' => Type::string(),

            ],
            'residuo_radical' => [

                'type' => Type::string(),

            ],
            'erosion' => [

                'type' => Type::string(),

            ],

            'desgaste' => [

                'type' => Type::string(),

            ],
            'cuello' => [

                'type' => Type::string(),

            ],
            'pieza_completa' => [

                'type' => Type::string(),

            ],
            'physical_ta' => [

                'type' => Type::string(),

            ],
            'Mezial' => [

                'type' => Type::string(),

            ],
            'distal' => [

                'type' => Type::string(),

            ],
            'oclusal' => [

                'type' => Type::string(),

            ],
            'palatina' => [

                'type' => Type::string(),

            ],
            'lingual' => [

                'type' => Type::string(),

            ],
            'vestibular' => [

                'type' => Type::string(),

            ],
            'cervical' => [

                'type' => Type::string(),

            ],
            'exodoncia' => [

                'type' => Type::string(),

            ],
            'obs' => [

                'type' => Type::string(),

            ],
            'status' => [

                'type' => Type::int(),

            ],
            'plan_status' => [

                'type' => Type::int(),

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
