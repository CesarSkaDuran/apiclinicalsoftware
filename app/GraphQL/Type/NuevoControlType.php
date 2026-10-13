<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class NuevoControlType extends GraphQLType

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
            'identification' => [

                'type' => Type::string(),

            ],



            'motive' => [

                'type' => Type::string(),

            ],


            'tests' => [

                'type' => Type::string()

            ],
            
            'behavior' => [
            
                'type' => Type::string()
            
               ],

           'process' => [
   
               'type' =>  Type::string()
   
              ],


            'family' => [

                'type' => Type::string(),

            ],

            'allergies' => [

                'type' => Type::string(),

            ],
            'allergies' => [

                'type' => Type::string(),

            ],

            'diagnostic' => [

                'type' => Type::string(),

            ],

            'toxicologist' => [

                'type' => Type::string(),

            ],

            'occupational' => [

                'type' => Type::string(),

            ],

            'diagnostic_type' => [

                'type' => Type::string(),

            ],

            'external_cause' => [

                'type' => Type::string(),

            ],

            'purpose' => [

                'type' => Type::string(),

            ],
            'procedure' => [

                'type' => Type::string(),

            ],
            'authorization_number' => [

                'type' => Type::string(),

            ],
            'surgical' => [

                'type' => Type::string(),

            ],
            'current_illness' => [

                'type' => Type::string(),

            ],
            'pathological' => [

                'type' => Type::string(),

            ],

            'notes' => [

                'type' => Type::string(),

            ],
            'diagnosis' => [

                'type' => Type::string(),

            ],
            'pharmacological' => [

                'type' => Type::string(),

            ],
            'physical_ta' => [

                'type' => Type::string(),

            ],
            'physical_fc' => [

                'type' => Type::string(),

            ],
            'weight' => [

                'type' => Type::string(),

            ],
            'height' => [

                'type' => Type::string(),

            ],
            'head' => [

                'type' => Type::string(),

            ],
            'neck' => [

                'type' => Type::string(),

            ],
            'thorax' => [

                'type' => Type::string(),

            ],
            'pregnancy' => [

                'type' => Type::string(),

            ],
            'exams' => [

                'type' => Type::string(),

            ],
            'sao' => [

                'type' => Type::string(),

            ],
            'temperature' => [

                'type' => Type::string(),

            ],
            'tension' => [

                'type' => Type::string(),

            ],
            'mental' => [

                'type' => Type::string(),

            ],
            'skin' => [

                'type' => Type::string(),

            ],
            'pulm' => [

                'type' => Type::string(),

            ],
            'abdomen' => [

                'type' => Type::string(),

            ],
            'extremities' => [

                'type' => Type::string(),

            ],
            'neurol' => [

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
