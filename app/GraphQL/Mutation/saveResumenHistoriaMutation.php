<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Record;

use App\ResumenHistoria;

/**

 * CreateFileMutation

 */



class saveResumenHistoriaMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('record');
    }



    public function args()

    {

        return [

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'esqueletico' => ['name' => 'esqueletico', 'type' => Type::string()],

            'dental' => ['name' => 'dental', 'type' => Type::string()],

            'funcional' => ['name' => 'funcional', 'type' => Type::string()],

            'estetico' => ['name' => 'estetico', 'type' => Type::string()],

            'periodontal' => ['name' => 'periodontal', 'type' => Type::string()],

            'estetica_facial' => ['name' => 'estetica_facial', 'type' => Type::string()],

            'estetica_dental' => ['name' => 'estetica_dental', 'type' => Type::string()],

            'oclusion_funcional' => ['name' => 'oclusion_funcional', 'type' => Type::string()],

            'esqueletico' => ['name' => 'esqueletico', 'type' => Type::string()],

            'atm' => ['name' => 'atm', 'type' => Type::string()],

            'periodoncia' => ['name' => 'periodoncia', 'type' => Type::string()],

            'requerimiento_paciente' => ['name' => 'requerimiento_paciente', 'type' => Type::string()],

            'plan_tratamiento' => ['name' => 'plan_tratamiento', 'type' => Type::string()],

            'limitacion' => ['name' => 'limitacion', 'type' => Type::string()],

            'pronostico' => ['name' => 'pronostico', 'type' => Type::string()],

            'interconsultas' => ['name' => 'interconsultas', 'type' => Type::string()],

            'radiografias' => ['name' => 'radiografias', 'type' => Type::string()],

           

        ];
    }



    public function rules()

    {

        return [

            'record_id' => ['required'],

            'esqueletico' => ['required']

        ];
    }



    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();



        $record = Record::where('identification', $args['record_id'])->first();



        if (!$record) {

            abort(404, 'Record not found');
        }



        $recordResumen = $record->resumen;



        if ($recordResumen) {

            if (isset($args['esqueletico'])) {
                $recordResumen->esqueletico = $args['esqueletico'];
            }

            if (isset($args['dental'])) {
                $recordResumen->dental = $args['dental'] != '.' ? $args['dental'] : '';
            }

            if (isset($args['funcional'])) {
                $recordResumen->funcional = $args['funcional'] != '.' ? $args['funcional'] : '';
            }

            if (isset($args['estetico'])) {
                $recordResumen->estetico = $args['estetico'] != '.' ? $args['estetico'] : '';
            }


            if (isset($args['periodontal'])) {
                $recordResumen->periodontal = $args['periodontal'] != '.' ? $args['periodontal'] : '';
            }

            if (isset($args['estetica_facial'])) {
                $recordResumen->estetica_facial = $args['estetica_facial'] != '.' ? $args['estetica_facial'] : '';
            }

            if (isset($args['estetica_dental'])) {
                $recordResumen->estetica_dental = $args['estetica_dental'] != '.' ? $args['estetica_dental'] : '';
            }

            if (isset($args['oclusion_funcional'])) {
                $recordResumen->oclusion_funcional = $args['oclusion_funcional'] != '.' ? $args['oclusion_funcional'] : '';
            }

            if (isset($args['esqueletico'])) {
                $recordResumen->esqueletico = $args['esqueletico'] != '.' ? $args['esqueletico'] : '';
            }

            if (isset($args['atm'])) {
                $recordResumen->atm = $args['atm'] != '.' ? $args['atm'] : '';
            }

            if (isset($args['periodoncia'])) {
                $recordResumen->periodoncia = $args['periodoncia'];
            }

            if (isset($args['requerimiento_paciente'])) {
                $recordResumen->requerimiento_paciente = $args['requerimiento_paciente'];
            }

            if (isset($args['plan_tratamiento'])) {
                $recordResumen->plan_tratamiento = $args['plan_tratamiento'];
            }

            if (isset($args['limitacion'])) {
                $recordResumen->limitacion = $args['limitacion'];
            }

            if (isset($args['pronostico'])) {
                $recordResumen->pronostico = $args['pronostico'];
            }

            if (isset($args['interconsultas'])) {
                $recordResumen->interconsultas = $args['interconsultas'];
            }

            if (isset($args['radiografias'])) {
                $recordResumen->radiografias = $args['radiografias'];
            }


            $recordResumen->save();
        
        } else {

            // make user with data

            $recordResumen = ResumenHistoria::create([

                'record_id' => $record->identification,

                'esqueletico' => $args['esqueletico'],

                'dental' => isset($args['dental']) && $args['dental'] != '.' ?  $args['dental'] : null,

                'funcional' => isset($args['funcional']) && $args['funcional'] != '.' ?  $args['funcional'] : null,

                'estetico' => isset($args['estetico']) && $args['estetico'] != '.' ?  $args['estetico'] : null,

                'periodontal' => isset($args['periodontal']) && $args['periodontal'] != '.' ?  $args['periodontal'] : null,

                'estetica_facial' => isset($args['estetica_facial']) && $args['estetica_facial'] != '.' ?  $args['estetica_facial'] : null,

                'estetica_dental' => isset($args['estetica_dental']) && $args['estetica_dental'] != '.' ?  $args['estetica_dental'] : null,

                'oclusion_funcional' => isset($args['oclusion_funcional']) && $args['oclusion_funcional'] != '.' ?  $args['oclusion_funcional'] : null,

                'esqueletico' => isset($args['esqueletico']) && $args['esqueletico'] != '.' ?  $args['esqueletico'] : null,

                'atm' => isset($args['atm']) && $args['atm'] != '.' ?  $args['atm'] : null,
                
                'periodoncia' => isset($args['periodoncia']) && $args['periodoncia'] != '.' ?  $args['periodoncia'] : null,
                
                'requerimiento_paciente' => isset($args['requerimiento_paciente']) && $args['requerimiento_paciente'] != '.' ? $args['requerimiento_paciente'] : null,
                
                'plan_tratamiento' => isset($args['plan_tratamiento']) && $args['plan_tratamiento'] != '.' ? $args['plan_tratamiento'] : null,
                
                'limitacion' => isset($args['limitacion']) && $args['limitacion'] != '.' ? $args['limitacion'] : null,
                
                'pronostico' => isset($args['pronostico']) && $args['pronostico'] != '.' ? $args['pronostico'] : null,
                
                'interconsultas' => isset($args['interconsultas']) && $args['interconsultas'] != '.' ? $args['interconsultas'] : null,
                
                'radiografias' => isset($args['radiografias']) && $args['radiografias'] != '.' ? $args['radiografias'] : null,
             

            ]);
        }



        return $record;
    }
}
