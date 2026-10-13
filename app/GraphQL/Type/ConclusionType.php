<?php



namespace App\GraphQL\Type;



use Folklore\GraphQL\Support\Facades\GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Type as GraphQLType;

use App\GraphQL\Type\Scalar\Timestamp;



/**

 * UserType

 */

class ConclusionType extends GraphQLType

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

            'surgical' => [

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

            'record_id' => [

                'type' => Type::string(),

            ],

            'tests' => [

                'type' => Type::string(),

            ],

            'behavior' => [

                'type' => Type::string(),

            ],

            'process' => [

                'type' => Type::string(),

            ],

            'pharmacological' => [

                'type' => Type::string(),

            ],

            'family' => [

                'type' => Type::string(),

            ],

            'allergies' => [

                'type' => Type::string(),

            ],

            'diagnostic' => [
                'type' => Type::int(),
            ],

            'toxicologist' => [

                'type' => Type::string(),

            ],

            'occupational' => [

                'type' => Type::string(),

            ],

            'diagnostic_type' => [
                'type' => Type::int(),
            ],

            'external_cause' => [
                'type' => Type::int(),
            ],

            'purpose' => [
                'type' => Type::int(),
            ],

            'procedure_id' => [
                'type' => Type::int(),
            ],

            'authorization_number' => [
                'type' => Type::string(),
            ],

            'cualCirugia_plastica' => [
                'type' => Type::string(),
            ],

            'current_illness' => [
                'type' => Type::string(),
            ],


            'eructivas' => [

                'type' => Type::string(),

            ],

            'cirugia_plastica' => [

                'type' => Type::string(),

            ],

            'problemas_tiroideos' => [

                'type' => Type::string(),

            ],

            'ulcera_peptica' => [

                'type' => Type::string(),

            ],

            'enfermedades_vasculares' => [

                'type' => Type::string(),

            ],

            'artritis' => [

                'type' => Type::string(),

            ],

            'diabetes' => [

                'type' => Type::string(),

            ],

            'hepatitis' => [

                'type' => Type::string(),

            ],

            'enfermedades_pulmonares' => [

                'type' => Type::string(),

            ],

            'flebitis' => [

                'type' => Type::string(),

            ],

            'transfusiones_sanguineas' => [

                'type' => Type::string(),

            ],

            'otro_cirugia' => [

                'type' => Type::string(),

            ],

            'cigarrillo' => [
                'type' => Type::string(),
            ],

            'alcohol' => [

                'type' => Type::string(),

            ],

            'problemas_articulares' => [

                'type' => Type::string(),

            ],

            'marcapasos' => [
                'type' => Type::string(),
            ],

            'presion_arterial' => [
                'type' => Type::string(),
            ],

            'infecciones' => [
                'type' => Type::string(),
            ],

            'cancer' => [
                'type' => Type::string(),
            ],

            'pregunta_ejercicio' => [
                'type' => Type::string(),
            ],
            'pregunta_dieta' => [
                'type' => Type::string(),
            ],



            'pregunta_corporal' => [

                'type' => Type::string(),

            ],

            'anomalias_congenitas' => [

                'type' => Type::string(),

            ],

            'cancer_familiar' => [

                'type' => Type::string(),

            ],

            'diabetes_familiar' => [

                'type' => Type::string(),

            ],

            'enfermedades_cardiacas' => [
                'type' => Type::string(),
            ],

            'tension' => [

                'type' => Type::string(),

            ],

            'embarazos' => [

                'type' => Type::string(),

            ],

            'hijos' => [
                'type' => Type::string(),
            ],

            'abortos' => [
                'type' => Type::string(),
            ],

            'g' => [
                'type' => Type::string(),
            ],

            'p' => [
                'type' => Type::string(),
            ],

            'c' => [
                'type' => Type::string(),
            ],
            'a' => [
                'type' => Type::string(),
            ],



            'labios' => [
                'type' => Type::string(),
            ],

            'mucosa' => [
                'type' => Type::string(),
            ],

            'frenillos' => [
                'type' => Type::string(),
            ],

            'paladar' => [

                'type' => Type::string(),
            ],

            'piso_boca' => [

                'type' => Type::string(),
            ],

            'glandula' => [

                'type' => Type::string(),
            ],

            'dolor_muscular' => [

                'type' => Type::string(),
            ],

            'dolor_articular' => [

                'type' => Type::string(),
            ],

            'alteracion_movimiento' => [

                'type' => Type::string(),
            ],

            'maloclusiones' => [

                'type' => Type::string(),
            ],

            'crecimiento_desarrollo' => [

                'type' => Type::string(),
            ],

            'faseta_desgaste' => [

                'type' => Type::string(),
            ],

            'respirador_oral' => [

                'type' => Type::string(),
            ],

            'succion_digital' => [

                'type' => Type::string(),
            ],
            
            'lengua' => [

                'type' => Type::string(),
            ],

            'lengua_protactil' => [

                'type' => Type::string(),
            ],

            'cigarrillo' => [
                'type' => Type::string(),
            ],

            'queliofagia' => [

                'type' => Type::string(),
            ],

            'fumador' => [

                'type' => Type::string(),
            ],

            'onicofagia' => [
                'type' => Type::string(),
            ],

            'hallazgo' => [
                'type' => Type::string(),
            ],

            'cambio_forma' => [
                'type' => Type::string(),
            ],

            'cambio_tamano' => [
                'type' => Type::string(),
            ],

            'cambio_numero' => [
                'type' => Type::string(),
            ],

            'cambio_color' => [
                'type' => Type::string(),
            ],

            'cambio_posicion' => [

                'type' => Type::string(),
            ],

            'impacto' => [

                'type' => Type::string(),
            ],

            'sesibilidad' => [

                'type' => Type::string(),
            ],

            'sangrado' => [

                'type' => Type::string(),
            ],

            'movilidad' => [
                'type' => Type::string(),
            ],

            'reseciones' => [

                'type' => Type::string(),
            ],

            'bolsa' => [

                'type' => Type::string(),
            ],

            'calculos' => [
                'type' => Type::string(),
            ],

            'abscesos' => [
                'type' => Type::string(),
            ],

            'erosion' => [
                'type' => Type::string(),
            ],


            'rel_diagnostic' => [

                'type' => GraphQL::type('diagnostic'),

                'description' => 'The user basic info',

            ],

            'rel_procedure' => [

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

