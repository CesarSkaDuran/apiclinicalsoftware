<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Odontograma;

class SaveOdontogramaMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or upendodoncia record'

    ];



    public function type()

    {

        return GraphQL::type('odontograma');
    }


    public function args()

    {

        return [
            
            'id' => ['name' => 'id', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'diente_id' => ['name' => 'diente_id', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'plan_status' => ['name' => 'plan_status', 'type' => Type::int()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],

            'corona' => ['name' => 'corona', 'type' => Type::string()],
            'corona_provisional' => ['name' => 'corona_provisional', 'type' => Type::string()],
            'endodoncia' => ['name' => 'endodoncia', 'type' => Type::string()],
            'ausente' => ['name' => 'ausente', 'type' => Type::string()],
            'restauracion' => ['name' => 'restauracion', 'type' => Type::string()],

            'implante' => ['name' => 'implante', 'type' => Type::string()],
            'perno_munon' => ['name' => 'perno_munon', 'type' => Type::string()],
            'otros' => ['name' => 'otros', 'type' => Type::string()],
            'protesis_removible' => ['name' => 'protesis_removible', 'type' => Type::string()],
            'amalgama' => ['name' => 'amalgama', 'type' => Type::string()],

            'sellante' => ['name' => 'sellante', 'type' => Type::string()],
            'diente_sano' => ['name' => 'diente_sano', 'type' => Type::string()],
            'caries' => ['name' => 'caries', 'type' => Type::string()],
            'infeccion_pulpar' => ['name' => 'infeccion_pulpar', 'type' => Type::string()],
            'fractura' => ['name' => 'fractura', 'type' => Type::string()],

            'movilidad' => ['name' => 'movilidad', 'type' => Type::string()],
            'residuo_radical' => ['name' => 'residuo_radical', 'type' => Type::string()],
            'erosion' => ['name' => 'erosion', 'type' => Type::string()],
            'desgaste' => ['name' => 'desgaste', 'type' => Type::string()],
            'cuello' => ['name' => 'cuello', 'type' => Type::string()],

            'pieza_completa' => ['name' => 'pieza_completa', 'type' => Type::string()],
            // 'physical_ta' => ['name' => 'physical_ta', 'type' => Type::string()],
            'Mezial' => ['name' => 'Mezial', 'type' => Type::string()],
            'distal' => ['name' => 'distal', 'type' => Type::string()],
            'oclusal' => ['name' => 'oclusal', 'type' => Type::string()],

            'palatina' => ['name' => 'palatina', 'type' => Type::string()],
            'lingual' => ['name' => 'lingual', 'type' => Type::string()],
            'vestibular' => ['name' => 'vestibular', 'type' => Type::string()],
            'exodoncia' => ['name' => 'exodoncia', 'type' => Type::string()],
            'cervical' => ['name' => 'cervical', 'type' => Type::string()],
            'obs' => ['name' => 'obs', 'type' => Type::string()],

        ];
    }



    public function rules()

    {

        return [];
    }



    public function resolve($root, $args)

    {
        $currentUser = auth('api')->user();

        if (isset($args['id'])) {

            $data = Odontograma::where('id', $args['id'])->first();
        } else {

            $data = null;
        }



        if ($data) {
            if (isset($args['delete'])) {
                Odontograma::where('id', $args['id'])->delete();

                return $data;
            }

            if (isset($args['corona'])) {
                $data->corona = $args['corona'] != '.' ? $args['corona'] : '';
            }

            if (isset($args['corona_provisional'])) {
                $data->corona_provisional = $args['corona_provisional'] != '.' ? $args['corona_provisional'] : '';
            }

            if (isset($args['ausente'])) {
                $data->ausente = $args['ausente'] != '.' ? $args['ausente'] : '';
            }

            if (isset($args['endodoncia'])) {
                $data->endodoncia = $args['endodoncia'] != '.' ? $args['endodoncia'] : '';
            }

            if (isset($args['restauracion'])) {
                $data->restauracion = $args['restauracion'] != '.' ? $args['restauracion'] : '';
            }


            if (isset($args['implante'])) {
                $data->implante = $args['implante'] != '.' ? $args['implante'] : '';
            }

            if (isset($args['perno_munon'])) {
                $data->perno_munon = $args['perno_munon'] != '.' ? $args['perno_munon'] : '';
            }

            if (isset($args['otros'])) {
                $data->otros = $args['otros'] != '.' ? $args['otros'] : '';
            }

            if (isset($args['protesis_removible'])) {
                $data->protesis_removible = $args['protesis_removible'] != '.' ? $args['protesis_removible'] : '';
            }

            if (isset($args['amalgama'])) {
                $data->amalgama = $args['amalgama'] != '.' ? $args['amalgama'] : '';
            }


            if (isset($args['sellante'])) {
                $data->sellante = $args['sellante'] != '.' ? $args['sellante'] : '';
            }

            if (isset($args['diente_sano'])) {
                $data->diente_sano = $args['diente_sano'] != '.' ? $args['diente_sano'] : '';
            }

            if (isset($args['caries'])) {
                $data->caries = $args['caries'] != '.' ? $args['caries'] : '';
            }

            if (isset($args['infeccion_pulpar'])) {
                $data->infeccion_pulpar = $args['infeccion_pulpar'] != '.' ? $args['infeccion_pulpar'] : '';
            }

            if (isset($args['fractura'])) {
                $data->fractura = $args['fractura'] != '.' ? $args['fractura'] : '';
            }

            if (isset($args['movilidad'])) {
                $data->movilidad = $args['movilidad'] != '.' ? $args['movilidad'] : '';
            }

            if (isset($args['residuo_radical'])) {
                $data->residuo_radical = $args['residuo_radical'] != '.' ? $args['residuo_radical'] : '';
            }

            if (isset($args['erosion'])) {
                $data->erosion = $args['erosion'] != '.' ? $args['erosion'] : '';
            }

            if (isset($args['desgaste'])) {
                $data->desgaste = $args['desgaste'] != '.' ? $args['desgaste'] : '';
            }

            if (isset($args['cuello'])) {
                $data->cuello = $args['cuello'] != '.' ? $args['cuello'] : '';
            }


            if (isset($args['pieza_completa'])) {
                $data->pieza_completa = $args['pieza_completa'] != '.' ? $args['pieza_completa'] : '';
            }

            // if (isset($args['physical_ta'])) {
            //     $data->physical_ta = $args['physical_ta'] != '.' ? $args['physical_ta'] : '';
            // }

            if (isset($args['Mezial'])) {
                $data->Mezial = $args['Mezial'] != '.' ? $args['Mezial'] : '';
            }

            if (isset($args['distal'])) {
                $data->distal = $args['distal'] != '.' ? $args['distal'] : '';
            }

            if (isset($args['oclusal'])) {
                $data->oclusal = $args['oclusal'] != '.' ? $args['oclusal'] : '';
            }

            if (isset($args['palatina'])) {
                $data->palatina = $args['palatina'] != '.' ? $args['palatina'] : '';
            }

            if (isset($args['lingual'])) {
                $data->lingual = $args['lingual'] != '.' ? $args['lingual'] : '';
            }

            if (isset($args['vestibular'])) {
                $data->vestibular = $args['vestibular'] != '.' ? $args['vestibular'] : '';
            }

            if (isset($args['exodoncia'])) {
                $data->exodoncia = $args['exodoncia'] != '.' ? $args['exodoncia'] : '';
            }
            if (isset($args['cervical'])) {
                $data->cervical = $args['cervical'] != '.' ? $args['cervical'] : '';
            }
            if (isset($args['plan_status'])) {
                $data->plan_status = $args['plan_status'] != '.' ? $args['plan_status'] : '';
            }
            if (isset($args['obs'])) {
                $data->obs = $args['obs'] != '.' ? $args['obs'] : '';
            }


            $data->save();

            
        } else {
            // make user with data
            $data = Odontograma::create([

                'diente_id' => isset($args['diente_id']) && $args['diente_id'] != '.' ? $args['diente_id'] : null,
                'record_id' => isset($args['record_id']) && $args['record_id'] != '.' ? $args['record_id'] : null,
                'status' => isset($args['status']) && $args['status'] != '.' ? $args['status'] : null,
                'corona' => isset($args['corona']) && $args['corona'] != '.' ? $args['corona'] : null,
                'corona_provisional' => isset($args['corona_provisional']) && $args['corona_provisional'] != '.' ? $args['corona_provisional'] : null,
                'endodoncia' => isset($args['endodoncia']) && $args['endodoncia'] != '.' ? $args['endodoncia'] : null,
                'ausente' => isset($args['ausente']) && $args['ausente'] != '.' ? $args['ausente'] : null,
                'restauracion' => isset($args['restauracion']) && $args['restauracion'] != '.' ? $args['restauracion'] : null,

                'implante' => isset($args['implante']) && $args['implante'] != '.' ? $args['implante'] : null,
                'perno_munon' => isset($args['perno_munon']) && $args['perno_munon'] != '.' ? $args['perno_munon'] : null,
                'otros' => isset($args['otros']) && $args['otros'] != '.' ? $args['otros'] : null,
                'protesis_removible' => isset($args['protesis_removible']) && $args['protesis_removible'] != '.' ? $args['protesis_removible'] : null,
                'amalgama' => isset($args['amalgama']) && $args['amalgama'] != '.' ? $args['amalgama'] : null,

                'sellante' => isset($args['sellante']) && $args['sellante'] != '.' ? $args['sellante'] : null,
                'diente_sano' => isset($args['diente_sano']) && $args['diente_sano'] != '.' ? $args['diente_sano'] : null,
                'caries' => isset($args['caries']) && $args['caries'] != '.' ? $args['caries'] : null,
                'infeccion_pulpar' => isset($args['infeccion_pulpar']) && $args['infeccion_pulpar'] != '.' ? $args['infeccion_pulpar'] : null,
                'fractura' => isset($args['fractura']) && $args['fractura'] != '.' ? $args['fractura'] : null,

                'movilidad' => isset($args['movilidad']) && $args['movilidad'] != '.' ? $args['movilidad'] : null,
                'residuo_radical' => isset($args['residuo_radical']) && $args['residuo_radical'] != '.' ? $args['residuo_radical'] : null,
                'erosion' => isset($args['erosion']) && $args['erosion'] != '.' ? $args['erosion'] : null,
                'desgaste' => isset($args['desgaste']) && $args['desgaste'] != '.' ? $args['desgaste'] : null,
                'cuello' => isset($args['cuello']) && $args['cuello'] != '.' ? $args['cuello'] : null,

                'pieza_completa' => isset($args['pieza_completa']) && $args['pieza_completa'] != '.' ? $args['pieza_completa'] : null,
                // 'physical_ta' => isset($args['physical_ta']) && $args['physical_ta'] != '.' ? $args['physical_ta'] : null,
                'Mezial' => isset($args['Mezial']) && $args['Mezial'] != '.' ? $args['Mezial'] : null,
                'distal' => isset($args['distal']) && $args['distal'] != '.' ? $args['distal'] : null,
                'oclusal' => isset($args['oclusal']) && $args['oclusal'] != '.' ? $args['oclusal'] : null,

                'palatina' => isset($args['palatina']) && $args['palatina'] != '.' ? $args['palatina'] : null,
                'lingual' => isset($args['lingual']) && $args['lingual'] != '.' ? $args['lingual'] : null,
                'vestibular' => isset($args['vestibular']) && $args['vestibular'] != '.' ? $args['vestibular'] : null,
                'cervical' => isset($args['cervical']) && $args['cervical'] != '.' ? $args['cervical'] : null,
                'exodoncia' => isset($args['exodoncia']) && $args['exodoncia'] != '.' ? $args['exodoncia'] : null,
                'obs' => isset($args['obs']) && $args['obs'] != '.' ? $args['obs'] : null,

                ]);
        }

        return $data;
    }
}
