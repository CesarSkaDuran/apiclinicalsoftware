<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use App\Examen;

/**
 * CreateFileMutation
 */

class ExamenesMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('examenes');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'otros' => ['name' => 'otros', 'type' => Type::string()],
            'orina' => ['name' => 'orina', 'type' => Type::string()],
            'quimica_sanguinea' => ['name' => 'quimica_sanguinea', 'type' => Type::string()],
            'material_fecal' => ['name' => 'material_fecal', 'type' => Type::string()],
            'varios' => ['name' => 'varios', 'type' => Type::string()],
            'ecografias' => ['name' => 'ecografias', 'type' => Type::string()],
            'resonancias' => ['name' => 'resonancias', 'type' => Type::string()],
            'tac' => ['name' => 'tac', 'type' => Type::string()],
            'hematologia' => ['name' => 'hematologia', 'type' => Type::string()],
            'obs' => ['name' => 'obs', 'type' => Type::string()],
            //examenes odontologia
            'radioIntraorales' => ['name' => 'radioIntraorales', 'type' => Type::string()],
            'radioExtraorales' => ['name' => 'radioExtraorales', 'type' => Type::string()],
            'fotoIntraorales' => ['name' => 'fotoIntraorales', 'type' => Type::string()],
            'fotoExtraorales' => ['name' => 'fotoExtraorales', 'type' => Type::string()],
            'modelos' => ['name' => 'modelos', 'type' => Type::string()],
            'paquete_diagnostico' => ['name' => 'paquete_diagnostico', 'type' => Type::string()],
            'cefalometria' => ['name' => 'cefalometria', 'type' => Type::string()],
            'tomografia' => ['name' => 'tomografia', 'type' => Type::string()],
            
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {

        $Examen = null;

        if (isset($args['id'])) {

            $Examen = Examen::where('id', $args['id'])->first();
        } else {

            $Examen = null;
        }

        
        
        if ($Examen) {
            
            if (isset($args['delete'])) {
                Examen::where('id', $args['id'])->delete();
    
                return $Examen;
            }
            if (isset($args['name'])) {
                $Examen->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            }

            if (isset($args['orina'])) {
                $Examen->orina = $args['orina'] != '.' ? urldecode($args['orina']) : '';
            }

            if (isset($args['otros'])) {
                $Examen->otros = $args['otros'] != '.' ? urldecode($args['otros']) : '';
            }

            if (isset($args['material_fecal'])) {
                $Examen->material_fecal = $args['material_fecal'] != '.' ? urldecode($args['material_fecal']) : '';
            }

            if (isset($args['varios'])) {
                $Examen->varios = $args['varios'] != '.' ? urldecode($args['varios']) : '';
            }

            if (isset($args['ecografias'])) {
                $Examen->ecografias = $args['ecografias'] != '.' ? urldecode($args['ecografias']) : '';
            }

            if (isset($args['resonancias'])) {
                $Examen->resonancias = $args['resonancias'] != '.' ? urldecode($args['resonancias']) : '';
            }

            if (isset($args['hematologia'])) {
                $Examen->hematologia = $args['hematologia'] != '.' ? urldecode($args['hematologia']) : '';
            }

            if (isset($args['tac'])) {
                $Examen->tac = $args['tac'] != '.' ? urldecode($args['tac']) : '';
            }

            if (isset($args['obs'])) {
                $Examen->obs = $args['obs'] != '.' ? urldecode($args['obs']) : '';
            }

            if (isset($args['quimica_sanguinea'])) {
                $Examen->quimica_sanguinea = $args['quimica_sanguinea'] != '.' ? urldecode($args['quimica_sanguinea']) : '';
            }


            if (isset($args['radioIntraorales'])) {
                $Examen->radioIntraorales = $args['radioIntraorales'] != '.' ? urldecode($args['radioIntraorales']) : '';
            }

            if (isset($args['radioExtraorales'])) {
                $Examen->radioExtraorales = $args['radioExtraorales'] != '.' ? urldecode($args['radioExtraorales']) : '';
            }

            if (isset($args['fotoIntraorales'])) {
                $Examen->fotoIntraorales = $args['fotoIntraorales'] != '.' ? urldecode($args['fotoIntraorales']) : '';
            }

            if (isset($args['fotoExtraorales'])) {
                $Examen->fotoExtraorales = $args['fotoExtraorales'] != '.' ? urldecode($args['fotoExtraorales']) : '';
            }

            if (isset($args['modelos'])) {
                $Examen->modelos = $args['modelos'] != '.' ? urldecode($args['modelos']) : '';
            }

            if (isset($args['paquete_diagnostico'])) {
                $Examen->paquete_diagnostico = $args['paquete_diagnostico'] != '.' ? urldecode($args['paquete_diagnostico']) : '';
            }

            if (isset($args['cefalometria'])) {
                $Examen->cefalometria = $args['cefalometria'] != '.' ? urldecode($args['cefalometria']) : '';
            }

            if (isset($args['tomografia'])) {
                $Examen->tomografia = $args['tomografia'] != '.' ? urldecode($args['tomografia']) : '';
            }

            $Examen->save();

        } else {

            $Examen = Examen::create([
            'record_id' => $args['record_id'],
            'name' => isset($args['name']) && $args['name'] != '.' ?  urldecode($args['name']) : '',
            'orina' => isset($args['orina']) && $args['orina'] != '.' ?  urldecode($args['orina']) : '',
            'otros' => isset($args['otros']) && $args['otros'] != '.' ?  urldecode($args['otros']) : '',
            'material_fecal' => isset($args['material_fecal']) && $args['material_fecal'] != '.' ?  urldecode($args['material_fecal']) : '',
            'varios' => isset($args['varios']) && $args['varios'] != '.' ?  urldecode($args['varios']) : '',
            'ecografias' => isset($args['ecografias']) && $args['ecografias'] != '.' ?  urldecode($args['ecografias']) : '',
            'resonancias' => isset($args['resonancias']) && $args['resonancias'] != '.' ?  urldecode($args['resonancias']) : '',
            'hematologia' => isset($args['hematologia']) && $args['hematologia'] != '.' ?  urldecode($args['hematologia']) : '',
            'tac' => isset($args['tac']) && $args['tac'] != '.' ?  urldecode($args['tac']) : '',
            'obs' => isset($args['obs']) && $args['obs'] != '.' ?  urldecode($args['obs']) : '',
            'quimica_sanguinea' => isset($args['quimica_sanguinea']) && $args['quimica_sanguinea'] != '.' ?  urldecode($args['quimica_sanguinea']) : '',
            
            'radioIntraorales' => isset($args['radioIntraorales']) && $args['radioIntraorales'] != '.' ?  urldecode($args['radioIntraorales']) : '',
            'radioExtraorales' => isset($args['radioExtraorales']) && $args['radioExtraorales'] != '.' ?  urldecode($args['radioExtraorales']) : '',
            'fotoIntraorales' => isset($args['fotoIntraorales']) && $args['fotoIntraorales'] != '.' ?  urldecode($args['fotoIntraorales']) : '',
            'fotoExtraorales' => isset($args['fotoExtraorales']) && $args['fotoExtraorales'] != '.' ?  urldecode($args['fotoExtraorales']) : '',
            'modelos' => isset($args['modelos']) && $args['modelos'] != '.' ?  urldecode($args['modelos']) : '',
            'paquete_diagnostico' => isset($args['paquete_diagnostico']) && $args['paquete_diagnostico'] != '.' ?  urldecode($args['paquete_diagnostico']) : '',
            'cefalometria' => isset($args['cefalometria']) && $args['cefalometria'] != '.' ?  urldecode($args['cefalometria']) : '',
            'tomografia' => isset($args['tomografia']) && $args['tomografia'] != '.' ?  urldecode($args['tomografia']) : '',
            ]);
        

        }
        return $Examen;
    }
}
