<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Conclusion;

use App\Record;



/**

 * CreateFileMutation

 */



class SaveConclusionMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('conclusion');
    }



    public function args()

    {

        return [

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'id' => ['name' => 'id', 'type' => Type::int()],

            'surgical' => ['name' => 'surgical', 'type' => Type::string()],

            'pathological' => ['name' => 'pathological', 'type' => Type::string()],

            'notes' => ['name' => 'notes', 'type' => Type::string()],

            'diagnosis' => ['name' => 'diagnosis', 'type' => Type::string()],

            'tests' => ['name' => 'tests', 'type' => Type::string()],

            'behavior' => ['name' => 'behavior', 'type' => Type::string()],

            'process' => ['name' => 'process', 'type' => Type::string()],

            'pharmacological' => ['name' => 'pharmacological', 'type' => Type::string()],

            'family' => ['name' => 'family', 'type' => Type::string()],

            'allergies' => ['name' => 'allergies', 'type' => Type::string()],

            'diagnostic' => ['name' => 'diagnostic', 'type' => Type::int()],
            
            'toxicologist' => ['name' => 'toxicologist', 'type' => Type::string()],
            
            'occupational' => ['name' => 'occupational', 'type' => Type::string()],
            
            'current_illness' => ['name' => 'current_illness', 'type' => Type::string()],
            
            'diagnostic_type' => ['name' => 'diagnostic_type', 'type' => Type::int()],
            
            'external_cause' => ['name' => 'external_cause', 'type' => Type::int()],
            
            'purpose' => ['name' => 'purpose', 'type' => Type::int()],
            
            'procedure' => ['name' => 'procedure', 'type' => Type::int()],
            
            'authorization_number' => ['name' => 'authorization_number', 'type' => Type::string()],

            'eructivas' => ['name' => 'eructivas', 'type' => Type::string()],

            'cualCirugia_plastica' => ['name' => 'cualCirugia_plastica', 'type' => Type::string()],
            
            'cirugia_plastica' => ['name' => 'cirugia_plastica', 'type' => Type::string()],

            'problemas_tiroideos' => ['name' => 'problemas_tiroideos', 'type' => Type::string()],

            'ulcera_peptica' => ['name' => 'ulcera_peptica', 'type' => Type::string()],

            'enfermedades_vasculares' => ['name' => 'enfermedades_vasculares', 'type' => Type::string()],

            'artritis' => ['name' => 'artritis', 'type' => Type::string()],

            'diabetes' => ['name' => 'diabetes', 'type' => Type::string()],

            'hepatitis' => ['name' => 'hepatitis', 'type' => Type::string()],

            'enfermedades_pulmonares' => ['name' => 'enfermedades_pulmonares', 'type' => Type::string()],

            'flebitis' => ['name' => 'flebitis', 'type' => Type::string()],

            'transfusiones_sanguineas' => ['name' => 'transfusiones_sanguineas', 'type' => Type::string()],

            'otro_cirugia' => ['name' => 'otro_cirugia', 'type' => Type::string()],

            'cigarrillo' => ['name' => 'cigarrillo', 'type' => Type::string()],

            'alcohol' => ['name' => 'alcohol', 'type' => Type::string()],

            'problemas_articulares' => ['name' => 'problemas_articulares', 'type' => Type::string()],

            'marcapasos' => ['name' => 'marcapasos', 'type' => Type::string()],

            'presion_arterial' => ['name' => 'presion_arterial', 'type' => Type::string()],

            'infecciones' => ['name' => 'infecciones', 'type' => Type::string()],

            'cancer' => ['name' => 'cancer', 'type' => Type::string()],

            'pregunta_ejercicio' => ['name' => 'pregunta_ejercicio', 'type' => Type::string()],

            'pregunta_dieta' => ['name' => 'pregunta_dieta', 'type' => Type::string()],

            'pregunta_corporal' => ['name' => 'pregunta_corporal', 'type' => Type::string()],

            'anomalias_congenitas' => ['name' => 'anomalias_congenitas', 'type' => Type::string()],

            'cancer_familiar' => ['name' => 'cancer_familiar', 'type' => Type::string()],

            'diabetes_familiar' => ['name' => 'diabetes_familiar', 'type' => Type::string()],

            'enfermedades_cardiacas' => ['name' => 'enfermedades_cardiacas', 'type' => Type::string()],

            'tension' => ['name' => 'tension', 'type' => Type::string()],

            'embarazos' => ['name' => 'embarazos', 'type' => Type::string()],

            'hijos' => ['name' => 'hijos', 'type' => Type::string()],

            'abortos' => ['name' => 'abortos', 'type' => Type::string()],

            'g' => ['name' => 'g', 'type' => Type::string()],

            'p' => ['name' => 'p', 'type' => Type::string()],

            'c' => ['name' => 'c', 'type' => Type::string()],

            'a' => ['name' => 'a', 'type' => Type::string()],




            'labios' => ['name' => 'labios', 'type' => Type::string()],

            'mucosa' => ['name' => 'mucosa', 'type' => Type::string()],

            'frenillos' => ['name' => 'frenillos', 'type' => Type::string()],

            'paladar' => ['name' => 'paladar', 'type' => Type::string()],

            'lengua' => ['name' => 'lengua', 'type' => Type::string()],

            'piso_boca' => ['name' => 'piso_boca', 'type' => Type::string()],

            'glandula' => ['name' => 'glandula', 'type' => Type::string()],

            'dolor_muscular' => ['name' => 'dolor_muscular', 'type' => Type::string()],

            'dolor_articular' => ['name' => 'dolor_articular', 'type' => Type::string()],

            'alteracion_movimiento' => ['name' => 'alteracion_movimiento', 'type' => Type::string()],

            'maloclusiones' => ['name' => 'maloclusiones', 'type' => Type::string()],

            'crecimiento_desarrollo' => ['name' => 'crecimiento_desarrollo', 'type' => Type::string()],

            'faseta_desgaste' => ['name' => 'faseta_desgaste', 'type' => Type::string()],

            'respirador_oral' => ['name' => 'respirador_oral', 'type' => Type::string()],

            'succion_digital' => ['name' => 'succion_digital', 'type' => Type::string()],

            'lengua_protactil' => ['name' => 'lengua_protactil', 'type' => Type::string()],

            'queliofagia' => ['name' => 'queliofagia', 'type' => Type::string()],

            'fumador' => ['name' => 'fumador', 'type' => Type::string()],

            'onicofagia' => ['name' => 'onicofagia', 'type' => Type::string()],

            'hallazgo' => ['name' => 'hallazgo', 'type' => Type::string()],

            'cambio_forma' => ['name' => 'cambio_forma', 'type' => Type::string()],

            'cambio_tamano' => ['name' => 'cambio_tamano', 'type' => Type::string()],

            'cambio_numero' => ['name' => 'cambio_numero', 'type' => Type::string()],

            'cambio_color' => ['name' => 'cambio_color', 'type' => Type::string()],

            'cambio_posicion' => ['name' => 'cambio_posicion', 'type' => Type::string()],

            'impacto' => ['name' => 'impacto', 'type' => Type::string()],

            'sesibilidad' => ['name' => 'sesibilidad', 'type' => Type::string()],

            'sangrado' => ['name' => 'sangrado', 'type' => Type::string()],

            'movilidad' => ['name' => 'movilidad', 'type' => Type::string()],

            'reseciones' => ['name' => 'reseciones', 'type' => Type::string()],

            'bolsa' => ['name' => 'bolsa', 'type' => Type::string()],

            'calculos' => ['name' => 'calculos', 'type' => Type::string()],

            'abscesos' => ['name' => 'abscesos', 'type' => Type::string()],

            'erosion' => ['name' => 'erosion', 'type' => Type::string()],

        ];
    }



    public function rules()

    {

        return [

            'record_id' => ['required'],

        ];
    }



    public function resolve($root, $args)

    {

        $conclusion = null;



        if (isset($args['id'])) {

            $conclusion = Conclusion::where('id', $args['id'])->first();
        } else {

            $conclusion = Conclusion::where('record_id', $args['record_id'])->first();
        }



        if ($conclusion) {

            if (isset($args['surgical'])) {

                $conclusion->surgical = strtoupper($args['surgical']) != '.' ? strtoupper($args['surgical']) : '';
            }



            if (isset($args['pathological'])) {

                $conclusion->pathological = strtoupper($args['pathological']) != '.' ? strtoupper($args['pathological']) : '';
            }



            if (isset($args['notes'])) {

                $conclusion->notes = strtoupper($args['notes']) != '.' ? strtoupper($args['notes']) : '';
            }



            if (isset($args['diagnosis'])) {

                $conclusion->diagnosis = strtoupper($args['diagnosis']) != '.' ? strtoupper($args['diagnosis']) : '';
            }



            if (isset($args['tests'])) {

                $conclusion->tests = strtoupper($args['tests']) != '.' ? strtoupper($args['tests']) : '';
            }



            if (isset($args['behavior'])) {

                $conclusion->behavior = strtoupper($args['behavior']) != '.' ? strtoupper($args['behavior']) : '';
            }


            if (isset($args['cualCirugia_plastica'])) {

                $conclusion->cualCirugia_plastica = strtoupper($args['cualCirugia_plastica']) != '.' ? strtoupper($args['cualCirugia_plastica']) : '';
            }

            if (isset($args['process'])) {

                $conclusion->process = strtoupper($args['process']) != '.' ? strtoupper($args['process']) : '';
            }

            if (isset($args['pharmacological'])) {

                $conclusion->pharmacological = strtoupper($args['pharmacological']) != '.' ? strtoupper($args['pharmacological']) : '';
            }

            if (isset($args['family'])) {

                $conclusion->family = strtoupper($args['family']) != '.' ? strtoupper($args['family']) : '';
            }

            if (isset($args['allergies'])) {

                $conclusion->allergies = strtoupper($args['allergies']) != '.' ? strtoupper($args['allergies']) : '';
            }

            if (isset($args['diagnostic'])) {
                $conclusion->diagnostic = strtoupper($args['diagnostic']) ?? null;
            }

            if (isset($args['toxicologist'])) {

                $conclusion->toxicologist = strtoupper($args['toxicologist']) != '.' ? strtoupper($args['toxicologist']) : '';
            }
            if (isset($args['current_illness'])) {

                $conclusion->current_illness = strtoupper($args['current_illness']) != '.' ? strtoupper($args['current_illness']) : '';
            }


            if (isset($args['occupational'])) {

                $conclusion->occupational = strtoupper($args['occupational']) != '.' ? strtoupper($args['occupational']) : '';
            }

            if (isset($args['diagnostic_type'])) {
                $conclusion->diagnostic_type = strtoupper($args['diagnostic_type']) ?? null;
            }

            if (isset($args['external_cause'])) {
                $conclusion->external_cause = strtoupper($args['external_cause']) ?? null;
            }

            if (isset($args['purpose'])) {
                $conclusion->purpose = strtoupper($args['purpose']) ?? null;
            }


            if (isset($args['procedure'])) {
                $conclusion->infecciones = strtoupper($args['procedure']) ?? null;
            }

            if (isset($args['authorization_number'])) {
                $conclusion->authorization_number = strtoupper($args['authorization_number']) ?? null;
            }


                if (isset($args['eructivas'])) {

                    $conclusion->eructivas = strtoupper($args['eructivas']) != '.' ? strtoupper($args['eructivas']) : '';
                }



                if (isset($args['cirugia_plastica'])) {

                    $conclusion->cirugia_plastica = strtoupper($args['cirugia_plastica']) != '.' ? strtoupper($args['cirugia_plastica']) : '';
                }



                if (isset($args['problemas_tiroideos'])) {

                    $conclusion->problemas_tiroideos = strtoupper($args['problemas_tiroideos']) != '.' ? strtoupper($args['problemas_tiroideos']) : '';
                }



                if (isset($args['ulcera_peptica'])) {

                    $conclusion->ulcera_peptica = strtoupper($args['ulcera_peptica']) != '.' ? strtoupper($args['ulcera_peptica']) : '';
                }



                if (isset($args['enfermedades_vasculares'])) {

                    $conclusion->enfermedades_vasculares = strtoupper($args['enfermedades_vasculares']) != '.' ? strtoupper($args['enfermedades_vasculares']) : '';
                }



                if (isset($args['artritis'])) {

                    $conclusion->artritis = strtoupper($args['artritis']) != '.' ? strtoupper($args['artritis']) : '';
                }



                if (isset($args['diabetes'])) {

                    $conclusion->diabetes = strtoupper($args['diabetes']) != '.' ? strtoupper($args['diabetes']) : '';
                }

                if (isset($args['hepatitis'])) {

                    $conclusion->hepatitis = strtoupper($args['hepatitis']) != '.' ? strtoupper($args['hepatitis']) : '';
                }

                if (isset($args['enfermedades_pulmonares'])) {

                    $conclusion->enfermedades_pulmonares = strtoupper($args['enfermedades_pulmonares']) != '.' ? strtoupper($args['enfermedades_pulmonares']) : '';
                }

                if (isset($args['flebitis'])) {

                    $conclusion->flebitis = strtoupper($args['flebitis']) != '.' ? strtoupper($args['flebitis']) : '';
                }

                if (isset($args['transfusiones_sanguineas'])) {
                    $conclusion->transfusiones_sanguineas = strtoupper($args['transfusiones_sanguineas']) ?? null;
                }

                if (isset($args['otro_cirugia'])) {

                    $conclusion->otro_cirugia = strtoupper($args['otro_cirugia']) != '.' ? strtoupper($args['otro_cirugia']) : '';
                }
                if (isset($args['cigarrillo'])) {

                    $conclusion->cigarrillo = strtoupper($args['cigarrillo']) != '.' ? strtoupper($args['cigarrillo']) : '';
                }


                if (isset($args['alcohol'])) {

                    $conclusion->alcohol = strtoupper($args['alcohol']) != '.' ? strtoupper($args['alcohol']) : '';
                }

                if (isset($args['problemas_articulares'])) {
                    $conclusion->problemas_articulares = strtoupper($args['problemas_articulares']) ?? null;
                }

                if (isset($args['marcapasos'])) {
                    $conclusion->marcapasos = strtoupper($args['marcapasos']) ?? null;
                }

                if (isset($args['presion_arterial'])) {
                    $conclusion->presion_arterial = strtoupper($args['presion_arterial']) ?? null;
                }


                if (isset($args['infecciones'])) {
                    $conclusion->infecciones = strtoupper($args['infecciones']) ?? null;
                }

                if (isset($args['cancer'])) {
                    $conclusion->cancer = strtoupper($args['cancer']) ?? null;
                }



            if (isset($args['pregunta_ejercicio'])) {

                $conclusion->pregunta_ejercicio = strtoupper($args['pregunta_ejercicio']) != '.' ? strtoupper($args['pregunta_ejercicio']) : '';
            }



            if (isset($args['pregunta_dieta'])) {

                $conclusion->pregunta_dieta = strtoupper($args['pregunta_dieta']) != '.' ? strtoupper($args['pregunta_dieta']) : '';
            }



            if (isset($args['pregunta_corporal'])) {

                $conclusion->pregunta_corporal = strtoupper($args['pregunta_corporal']) != '.' ? strtoupper($args['pregunta_corporal']) : '';
            }



            if (isset($args['anomalias_congenitas'])) {

                $conclusion->anomalias_congenitas = strtoupper($args['anomalias_congenitas']) != '.' ? strtoupper($args['anomalias_congenitas']) : '';
            }



            if (isset($args['cancer_familiar'])) {

                $conclusion->cancer_familiar = strtoupper($args['cancer_familiar']) != '.' ? strtoupper($args['cancer_familiar']) : '';
            }



            if (isset($args['diabetes_familiar'])) {

                $conclusion->diabetes_familiar = strtoupper($args['diabetes_familiar']) != '.' ? strtoupper($args['diabetes_familiar']) : '';
            }



            if (isset($args['enfermedades_cardiacas'])) {

                $conclusion->enfermedades_cardiacas = strtoupper($args['enfermedades_cardiacas']) != '.' ? strtoupper($args['enfermedades_cardiacas']) : '';
            }

            if (isset($args['tension'])) {

                $conclusion->tension = strtoupper($args['tension']) != '.' ? strtoupper($args['tension']) : '';
            }

            if (isset($args['embarazos'])) {

                $conclusion->embarazos = strtoupper($args['embarazos']) != '.' ? strtoupper($args['embarazos']) : '';
            }

            if (isset($args['hijos'])) {

                $conclusion->hijos = strtoupper($args['hijos']) != '.' ? strtoupper($args['hijos']) : '';
            }

            if (isset($args['abortos'])) {
                $conclusion->abortos = strtoupper($args['abortos']) ?? null;
            }

            if (isset($args['g'])) {

                $conclusion->g = strtoupper($args['g']) != '.' ? strtoupper($args['g']) : '';
            }
            if (isset($args['p'])) {

                $conclusion->p = strtoupper($args['p']) != '.' ? strtoupper($args['p']) : '';
            }


            if (isset($args['c'])) {

                $conclusion->c = strtoupper($args['c']) != '.' ? strtoupper($args['c']) : '';
            }

            if (isset($args['a'])) {
                $conclusion->a = strtoupper($args['a']) ?? null;
            }



            if (isset($args['labios'])) {

                $conclusion->labios = strtoupper($args['labios']) != '.' ? strtoupper($args['labios']) : '';
            }



            if (isset($args['mucosa'])) {

                $conclusion->mucosa = strtoupper($args['mucosa']) != '.' ? strtoupper($args['mucosa']) : '';
            }



            if (isset($args['frenillos'])) {

                $conclusion->frenillos = strtoupper($args['frenillos']) != '.' ? strtoupper($args['frenillos']) : '';
            }



            if (isset($args['paladar'])) {

                $conclusion->paladar = strtoupper($args['paladar']) != '.' ? strtoupper($args['paladar']) : '';
            }



            if (isset($args['lengua'])) {

                $conclusion->lengua = strtoupper($args['lengua']) != '.' ? strtoupper($args['lengua']) : '';
            }



            if (isset($args['piso_boca'])) {

                $conclusion->piso_boca = strtoupper($args['piso_boca']) != '.' ? strtoupper($args['piso_boca']) : '';
            }



            if (isset($args['glandula'])) {

                $conclusion->glandula = strtoupper($args['glandula']) != '.' ? strtoupper($args['glandula']) : '';
            }

            if (isset($args['dolor_muscular'])) {

                $conclusion->dolor_muscular = strtoupper($args['dolor_muscular']) != '.' ? strtoupper($args['dolor_muscular']) : '';
            }

            if (isset($args['dolor_articular'])) {

                $conclusion->dolor_articular = strtoupper($args['dolor_articular']) != '.' ? strtoupper($args['dolor_articular']) : '';
            }

            if (isset($args['alteracion_movimiento'])) {

                $conclusion->alteracion_movimiento = strtoupper($args['alteracion_movimiento']) != '.' ? strtoupper($args['alteracion_movimiento']) : '';
            }

            if (isset($args['transfusiones_sanguineas'])) {
                $conclusion->transfusiones_sanguineas = strtoupper($args['transfusiones_sanguineas']) ?? null;
            }

            if (isset($args['maloclusiones'])) {

                $conclusion->maloclusiones = strtoupper($args['maloclusiones']) != '.' ? strtoupper($args['maloclusiones']) : '';
            }
            if (isset($args['crecimiento_desarrollo'])) {

                $conclusion->crecimiento_desarrollo = strtoupper($args['crecimiento_desarrollo']) != '.' ? strtoupper($args['crecimiento_desarrollo']) : '';
            }


            if (isset($args['faseta_desgaste'])) {

                $conclusion->faseta_desgaste = strtoupper($args['faseta_desgaste']) != '.' ? strtoupper($args['faseta_desgaste']) : '';
            }

            if (isset($args['respirador_oral'])) {
                $conclusion->respirador_oral = strtoupper($args['respirador_oral']) ?? null;
            }

            if (isset($args['succion_digital'])) {
                $conclusion->succion_digital = strtoupper($args['succion_digital']) ?? null;
            }

            if (isset($args['lengua_protactil'])) {
                $conclusion->lengua_protactil = strtoupper($args['lengua_protactil']) ?? null;
            }


            if (isset($args['fumador'])) {
                $conclusion->fumador = strtoupper($args['fumador']) ?? null;
            }

            if (isset($args['onicofagia'])) {
                $conclusion->onicofagia = strtoupper($args['onicofagia']) ?? null;
            }



            if (isset($args['hallazgo'])) {

                $conclusion->hallazgo = strtoupper($args['hallazgo']) != '.' ? strtoupper($args['hallazgo']) : '';
            }



            if (isset($args['cambio_forma'])) {

                $conclusion->cambio_forma = strtoupper($args['cambio_forma']) != '.' ? strtoupper($args['cambio_forma']) : '';
            }



            if (isset($args['cambio_tamano'])) {

                $conclusion->cambio_tamano = strtoupper($args['cambio_tamano']) != '.' ? strtoupper($args['cambio_tamano']) : '';
            }



            if (isset($args['cambio_numero'])) {

                $conclusion->cambio_numero = strtoupper($args['cambio_numero']) != '.' ? strtoupper($args['cambio_numero']) : '';
            }



            if (isset($args['cambio_color'])) {

                $conclusion->cambio_color = strtoupper($args['cambio_color']) != '.' ? strtoupper($args['cambio_color']) : '';
            }



            if (isset($args['cambio_posicion'])) {

                $conclusion->cambio_posicion = strtoupper($args['cambio_posicion']) != '.' ? strtoupper($args['cambio_posicion']) : '';
            }



            if (isset($args['impacto'])) {

                $conclusion->impacto = strtoupper($args['impacto']) != '.' ? strtoupper($args['impacto']) : '';
            }

            if (isset($args['sesibilidad'])) {

                $conclusion->sesibilidad = strtoupper($args['sesibilidad']) != '.' ? strtoupper($args['sesibilidad']) : '';
            }

            if (isset($args['sangrado'])) {

                $conclusion->sangrado = strtoupper($args['sangrado']) != '.' ? strtoupper($args['sangrado']) : '';
            }

            if (isset($args['movilidad'])) {

                $conclusion->movilidad = strtoupper($args['movilidad']) != '.' ? strtoupper($args['movilidad']) : '';
            }

            if (isset($args['reseciones'])) {
                $conclusion->reseciones = strtoupper($args['reseciones']) ?? null;
            }

            if (isset($args['bolsa'])) {

                $conclusion->bolsa = strtoupper($args['bolsa']) != '.' ? strtoupper($args['bolsa']) : '';
            }
            if (isset($args['queliofagia'])) {

                $conclusion->queliofagia = strtoupper($args['queliofagia']) != '.' ? strtoupper($args['queliofagia']) : '';
            }
            if (isset($args['calculos'])) {

                $conclusion->calculos = strtoupper($args['calculos']) != '.' ? strtoupper($args['calculos']) : '';
            }


            if (isset($args['abscesos'])) {

                $conclusion->abscesos = strtoupper($args['abscesos']) != '.' ? strtoupper($args['abscesos']) : '';
            }

            if (isset($args['erosion'])) {
                $conclusion->erosion = strtoupper($args['erosion']) ?? null;
            }

            $conclusion->save();
        } else {

            // make user with data

            $conclusion = Conclusion::create([

                'record_id' => $args['record_id'],

                'surgical' => isset($args['surgical']) && $args['surgical'] != '.' ?  strtoupper($args['surgical']) : null,

                'pathological' => isset($args['pathological']) && $args['pathological'] != '.' ?  strtoupper($args['pathological']) : null,

                'notes' => isset($args['notes']) && $args['notes'] != '.' ?  strtoupper($args['notes']) : null,

                'diagnosis' => isset($args['diagnosis']) && $args['diagnosis'] != '.' ?  strtoupper($args['diagnosis']) : null,

                'tests' => isset($args['tests']) && $args['tests'] != '.' ?  strtoupper($args['tests']) : null,

                'behavior' => isset($args['behavior']) && $args['behavior'] != '.' ?  strtoupper($args['behavior']) : null,

                'process' => isset($args['process']) && $args['process'] != '.' ?  strtoupper($args['process']) : null,
                
                'pharmacological' => isset($args['pharmacological']) && $args['pharmacological'] != '.' ?  strtoupper($args['pharmacological']) : null,
                
                'family' => isset($args['family']) && $args['family'] != '.' ?  strtoupper($args['family']) : null,
                
                'allergies' => isset($args['allergies']) && $args['allergies'] != '.' ?  strtoupper($args['allergies']) : null,
                
                'diagnostic' => $args['diagnostic'] ?? null,
                
                'toxicologist' => isset($args['toxicologist']) && $args['toxicologist'] != '.' ?  strtoupper($args['toxicologist']) : null,
                
                'current_illness' => isset($args['current_illness']) && $args['current_illness'] != '.' ?  strtoupper($args['current_illness']) : null,
                
                'occupational' => isset($args['occupational']) && $args['occupational'] != '.' ?  strtoupper($args['occupational']) : null,
                
                'diagnostic_type' => $args['diagnostic_type'] ?? null,
                
                'external_cause' => $args['external_cause'] ?? null,
                
                'purpose' => $args['purpose'] ?? null,
                
                'procedure_id' => $args['procedure'] ?? null,
                
                'authorization_number' => $args['authorization_number'] ?? null,

                'eructivas' => isset($args['eructivas']) && $args['eructivas'] != '.' ?  strtoupper($args['eructivas']) : null,

                'cualCirugia_plastica' => isset($args['cualCirugia_plastica']) && $args['cualCirugia_plastica'] != '.' ?  strtoupper($args['cualCirugia_plastica']) : null,

                'cirugia_plastica' => isset($args['cirugia_plastica']) && $args['cirugia_plastica'] != '.' ?  strtoupper($args['cirugia_plastica']) : null,

                'problemas_tiroideos' => isset($args['problemas_tiroideos']) && $args['problemas_tiroideos'] != '.' ?  strtoupper($args['problemas_tiroideos']) : null,

                'ulcera_peptica' => isset($args['ulcera_peptica']) && $args['ulcera_peptica'] != '.' ?  strtoupper($args['ulcera_peptica']) : null,

                'enfermedades_vasculares' => isset($args['enfermedades_vasculares']) && $args['enfermedades_vasculares'] != '.' ?  strtoupper($args['enfermedades_vasculares']) : null,

                'artritis' => isset($args['artritis']) && $args['artritis'] != '.' ?  strtoupper($args['artritis']) : null,

                'diabetes' => isset($args['diabetes']) && $args['diabetes'] != '.' ?  strtoupper($args['diabetes']) : null,
                
                'hepatitis' => isset($args['hepatitis']) && $args['hepatitis'] != '.' ?  strtoupper($args['hepatitis']) : null,
                
                'enfermedades_pulmonares' => isset($args['enfermedades_pulmonares']) && $args['enfermedades_pulmonares'] != '.' ?  strtoupper($args['enfermedades_pulmonares']) : null,
                
                'flebitis' => isset($args['flebitis']) && $args['flebitis'] != '.' ?  strtoupper($args['flebitis']) : null,
                
                'transfusiones_sanguineas' => $args['transfusiones_sanguineas'] ?? null,
                
                'otro_cirugia' => isset($args['otro_cirugia']) && $args['otro_cirugia'] != '.' ?  strtoupper($args['otro_cirugia']) : null,
                
                'cigarrillo' => isset($args['cigarrillo']) && $args['cigarrillo'] != '.' ?  strtoupper($args['cigarrillo']) : null,
                
                'alcohol' => isset($args['alcohol']) && $args['alcohol'] != '.' ?  strtoupper($args['alcohol']) : null,
                
                'problemas_articulares' => $args['problemas_articulares'] ?? null,
                
                'marcapasos' => $args['marcapasos'] ?? null,
                
                'presion_arterial' => $args['presion_arterial'] ?? null,
                
                'infecciones' => $args['infecciones'] ?? null,
                
                'cancer' => $args['cancer'] ?? null,

                'pregunta_ejercicio' => isset($args['pregunta_ejercicio']) && $args['pregunta_ejercicio'] != '.' ?  strtoupper($args['pregunta_ejercicio']) : null,

                'pregunta_dieta' => isset($args['pregunta_dieta']) && $args['pregunta_dieta'] != '.' ?  strtoupper($args['pregunta_dieta']) : null,

                'pregunta_corporal' => isset($args['pregunta_corporal']) && $args['pregunta_corporal'] != '.' ?  strtoupper($args['pregunta_corporal']) : null,

                'anomalias_congenitas' => isset($args['anomalias_congenitas']) && $args['anomalias_congenitas'] != '.' ?  strtoupper($args['anomalias_congenitas']) : null,

                'cancer_familiar' => isset($args['cancer_familiar']) && $args['cancer_familiar'] != '.' ?  strtoupper($args['cancer_familiar']) : null,

                'diabetes_familiar' => isset($args['diabetes_familiar']) && $args['diabetes_familiar'] != '.' ?  strtoupper($args['diabetes_familiar']) : null,
                
                'enfermedades_cardiacas' => isset($args['enfermedades_cardiacas']) && $args['enfermedades_cardiacas'] != '.' ?  strtoupper($args['enfermedades_cardiacas']) : null,
                
                'tension' => isset($args['tension']) && $args['tension'] != '.' ?  strtoupper($args['tension']) : null,
                
                'embarazos' => isset($args['embarazos']) && $args['embarazos'] != '.' ?  strtoupper($args['embarazos']) : null,
                
                'hijos' => isset($args['hijos']) && $args['hijos'] != '.' ?  strtoupper($args['hijos']) : null,
                
                'abortos' => $args['abortos'] ?? null,
                
                'g' => isset($args['g']) && $args['g'] != '.' ?  strtoupper($args['g']) : null,
                
                'p' => isset($args['p']) && $args['p'] != '.' ?  strtoupper($args['p']) : null,
                
                'c' => isset($args['c']) && $args['c'] != '.' ?  strtoupper($args['c']) : null,
                
                'a' => $args['a'] ?? null,

                'labios' => isset($args['labios']) && $args['labios'] != '.' ?  strtoupper($args['labios']) : null,

                'mucosa' => isset($args['mucosa']) && $args['mucosa'] != '.' ?  strtoupper($args['mucosa']) : null,

                'frenillos' => isset($args['frenillos']) && $args['frenillos'] != '.' ?  strtoupper($args['frenillos']) : null,

                'paladar' => isset($args['paladar']) && $args['paladar'] != '.' ?  strtoupper($args['paladar']) : null,

                'lengua' => isset($args['lengua']) && $args['lengua'] != '.' ?  strtoupper($args['lengua']) : null,

                'piso_boca' => isset($args['piso_boca']) && $args['piso_boca'] != '.' ?  strtoupper($args['piso_boca']) : null,

                'glandula' => isset($args['glandula']) && $args['glandula'] != '.' ?  strtoupper($args['glandula']) : null,

                'dolor_muscular' => isset($args['dolor_muscular']) && $args['dolor_muscular'] != '.' ?  strtoupper($args['dolor_muscular']) : null,

                'dolor_articular' => isset($args['dolor_articular']) && $args['dolor_articular'] != '.' ?  strtoupper($args['dolor_articular']) : null,

                'alteracion_movimiento' => isset($args['alteracion_movimiento']) && $args['alteracion_movimiento'] != '.' ?  strtoupper($args['alteracion_movimiento']) : null,

                'maloclusiones' => $args['maloclusiones'] ?? null,

                'crecimiento_desarrollo' => isset($args['crecimiento_desarrollo']) && $args['crecimiento_desarrollo'] != '.' ?  strtoupper($args['crecimiento_desarrollo']) : null,

                'faseta_desgaste' => isset($args['faseta_desgaste']) && $args['faseta_desgaste'] != '.' ?  strtoupper($args['faseta_desgaste']) : null,

                'respirador_oral' => isset($args['respirador_oral']) && $args['respirador_oral'] != '.' ?  strtoupper($args['respirador_oral']) : null,

                'succion_digital' => $args['succion_digital'] ?? null,

                'lengua_protactil' => $args['lengua_protactil'] ?? null,

                'queliofagia' => $args['queliofagia'] ?? null,

                'fumador' => $args['fumador'] ?? null,

                'onicofagia' => $args['onicofagia'] ?? null,

                'hallazgo' => isset($args['hallazgo']) && $args['hallazgo'] != '.' ?  strtoupper($args['hallazgo']) : null,

                'cambio_forma' => isset($args['cambio_forma']) && $args['cambio_forma'] != '.' ?  strtoupper($args['cambio_forma']) : null,

                'cambio_tamano' => isset($args['cambio_tamano']) && $args['cambio_tamano'] != '.' ?  strtoupper($args['cambio_tamano']) : null,

                'cambio_numero' => isset($args['cambio_numero']) && $args['cambio_numero'] != '.' ?  strtoupper($args['cambio_numero']) : null,

                'cambio_color' => isset($args['cambio_color']) && $args['cambio_color'] != '.' ?  strtoupper($args['cambio_color']) : null,

                'cambio_posicion' => isset($args['cambio_posicion']) && $args['cambio_posicion'] != '.' ?  strtoupper($args['cambio_posicion']) : null,

                'impacto' => isset($args['impacto']) && $args['impacto'] != '.' ?  strtoupper($args['impacto']) : null,

                'sesibilidad' => isset($args['sesibilidad']) && $args['sesibilidad'] != '.' ?  strtoupper($args['sesibilidad']) : null,

                'sangrado' => isset($args['sangrado']) && $args['sangrado'] != '.' ?  strtoupper($args['sangrado']) : null,

                'movilidad' => isset($args['movilidad']) && $args['movilidad'] != '.' ?  strtoupper($args['movilidad']) : null,

                'reseciones' => isset($args['reseciones']) && $args['reseciones'] != '.' ?  strtoupper($args['reseciones']) : null,

                'bolsa' => $args['bolsa'] ?? null,

                'calculos' => isset($args['calculos']) && $args['calculos'] != '.' ?  strtoupper($args['calculos']) : null,

                'abscesos' => isset($args['abscesos']) && $args['abscesos'] != '.' ?  strtoupper($args['abscesos']) : null,

                'erosion' => isset($args['erosion']) && $args['erosion'] != '.' ?  strtoupper($args['erosion']) : null,
            
            ]);
        }



        return $conclusion;
    }
}
