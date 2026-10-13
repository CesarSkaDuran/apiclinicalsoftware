<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\NuevoControl;

use App\Record;



/**

 * CreateFileMutation

 */



class SaveNuevoControlMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('nuevoControl');
    }



    public function args()

    {

        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'identification' =>['name' => 'identification', 'type' => Type::string()],

            'tests' => ['name' => 'tests', 'type' => Type::string()],

            'behavior' => ['name' => 'behavior', 'type' => Type::string()],

            'process' => ['name' => 'process', 'type' => Type::string()],

            'motive' => ['name' => 'motive', 'type' => Type::string()],

            'family' => ['name' => 'family', 'type' => Type::string()],

            'allergies' => ['name' => 'allergies', 'type' => Type::string()],

            'diagnostic' => ['name' => 'diagnostic', 'type' => Type::string()],

            'toxicologist' => ['name' => 'toxicologist', 'type' => Type::string()],

            'occupational' => ['name' => 'occupational', 'type' => Type::string()],

            'diagnostic_type' => ['name' => 'diagnostic_type', 'type' => Type::string()],

            'external_cause' => ['name' => 'external_cause', 'type' => Type::string()],

            'purpose' => ['name' => 'purpose', 'type' => Type::string()],

            'procedure' => ['name' => 'procedure', 'type' => Type::string()],

            'authorization_number' => ['name' => 'authorization_number', 'type' => Type::string()],

            'surgical' => ['name' => 'surgical', 'type' => Type::string()],

            'current_illness' => ['name' => 'current_illness', 'type' => Type::string()],

            'pathological' => ['name' => 'pathological', 'type' => Type::string()],

            'notes' => ['name' => 'notes', 'type' => Type::string()],

            'diagnosis' => ['name' => 'diagnosis', 'type' => Type::string()],

            'pharmacological' => ['name' => 'pharmacological', 'type' => Type::string()],

            'physical_ta' => ['name' => 'physical_ta', 'type' => Type::string()],

            'physical_fc' => ['name' => 'physical_fc', 'type' => Type::string()],

            'weight' => ['name' => 'weight', 'type' => Type::string()],

            'height' => ['name' => 'height', 'type' => Type::string()],

            'head' => ['name' => 'head', 'type' => Type::string()],

            'neck' => ['name' => 'neck', 'type' => Type::string()],

            'thorax' => ['name' => 'thorax', 'type' => Type::string()],

            'pregnancy' => ['name' => 'pregnancy', 'type' => Type::string()],

            'exams' => ['name' => 'exams', 'type' => Type::string()],

            'sao' => ['name' => 'sao', 'type' => Type::string()],

            'temperature' => ['name' => 'temperature', 'type' => Type::string()],

            'tension' => ['name' => 'tension', 'type' => Type::string()],

            'mental' => ['name' => 'mental', 'type' => Type::string()],

            'skin' => ['name' => 'skin', 'type' => Type::string()],

            'pulm' => ['name' => 'pulm', 'type' => Type::string()],

            'abdomen' => ['name' => 'abdomen', 'type' => Type::string()],

            'extremities' => ['name' => 'extremities', 'type' => Type::string()],

            'neurol' => ['name' => 'neurol', 'type' => Type::string()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],


        ];
    }



    public function rules()

    {

        return [

            // 'identification' => ['required'],

        ];
    }



    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();

        
      

        $record = Record::where('identification', $args['identification'])->first();



        // if (!$record) {

        //     abort(404, 'Record not found');
        // }


        if (isset($args['id'])) {
        
            $NuevoControl = NuevoControl::where('id', $args['id'])->first();
        
        } else {

            $NuevoControl = null;
        
        }



        if ($NuevoControl) {

            if (isset($args['delete'])) {
               
                $NuevoControl = NuevoControl::where('id', $args['id'])->delete();

                return $NuevoControl;
            }

            if (isset($args['tests'])) {

                $NuevoControl->tests = $args['tests'] != '.' ? $args['tests'] : '';
            }


            if (isset($args['behavior'])) {

                $NuevoControl->behavior = $args['behavior'] != '.' ? $args['behavior'] : '';
            }


            if (isset($args['process'])) {

                $NuevoControl->process = $args['process'] != '.' ? $args['process'] : '';
            }


            if (isset($args['motive'])) {

                $NuevoControl->motive = $args['motive'] != '.' ? $args['motive'] : '';
            }

     
            if (isset($args['family'])) {

                $NuevoControl->family = $args['family'] != '.' ? $args['family'] : '';
            }


            if (isset($args['allergies'])) {

                $NuevoControl->allergies = $args['allergies'] != '.' ? $args['allergies'] : '';
            }

            if (isset($args['diagnostic'])) {

                $NuevoControl->diagnostic = $args['diagnostic'] != '.' ? $args['diagnostic'] : '';
            }

            if (isset($args['toxicologist'])) {

                $NuevoControl->toxicologist = $args['toxicologist'] != '.' ? $args['toxicologist'] : '';
            }


            if (isset($args['occupational'])) {

                $NuevoControl->occupational = $args['occupational'] != '.' ? $args['occupational'] : '';
            }

            if (isset($args['diagnostic_type'])) {

                $NuevoControl->diagnostic_type = $args['diagnostic_type'] != '.' ? $args['diagnostic_type'] : '';
            }

            if (isset($args['external_cause'])) {

                $NuevoControl->external_cause = $args['external_cause'] != '.' ? $args['external_cause'] : '';
            }


            if (isset($args['purpose'])) {

                $NuevoControl->purpose = $args['purpose'] != '.' ? $args['purpose'] : '';
            }

            if (isset($args['procedure'])) {

                $NuevoControl->procedure = $args['procedure'] != '.' ? $args['procedure'] : '';
            }

            if (isset($args['authorization_number'])) {

                $NuevoControl->authorization_number = $args['authorization_number'] != '.' ? $args['authorization_number'] : '';
            }

            if (isset($args['surgical'])) {

                $NuevoControl->surgical = $args['surgical'] != '.' ? $args['surgical'] : '';
            }

            if (isset($args['current_illness'])) {

                $NuevoControl->current_illness = $args['current_illness'] != '.' ? $args['current_illness'] : '';
            }

            if (isset($args['pathological'])) {

                $NuevoControl->pathological = $args['pathological'] != '.' ? $args['pathological'] : '';
            }


            if (isset($args['notes'])) {

                $NuevoControl->notes = $args['notes'] != '.' ? $args['notes'] : '';
            }

            if (isset($args['diagnosis'])) {

                $NuevoControl->diagnosis = $args['diagnosis'] != '.' ? $args['diagnosis'] : '';
            }

            if (isset($args['pharmacological'])) {

                $NuevoControl->pharmacological = $args['pharmacological'] != '.' ? $args['pharmacological'] : '';
            }


            if (isset($args['physical_ta'])) {

                $NuevoControl->physical_ta = $args['physical_ta'] != '.' ? $args['physical_ta'] : '';
            }

            if (isset($args['physical_fc'])) {

                $NuevoControl->physical_fc = $args['physical_fc'] != '.' ? $args['physical_fc'] : '';
            }

            if (isset($args['weight'])) {

                $NuevoControl->weight = $args['weight'] != '.' ? $args['weight'] : '';
            }


            if (isset($args['height'])) {

                $NuevoControl->height = $args['height'] != '.' ? $args['height'] : '';
            }

            if (isset($args['neck'])) {

                $NuevoControl->neck = $args['neck'] != '.' ? $args['neck'] : '';
            }

            if (isset($args['thorax'])) {

                $NuevoControl->thorax = $args['thorax'] != '.' ? $args['thorax'] : '';
            }


            if (isset($args['pregnancy'])) {

                $NuevoControl->pregnancy = $args['pregnancy'] != '.' ? $args['pregnancy'] : '';
            }

            if (isset($args['exams'])) {

                $NuevoControl->exams = $args['exams'] != '.' ? $args['exams'] : '';
            }

            if (isset($args['sao'])) {

                $NuevoControl->sao = $args['sao'] != '.' ? $args['sao'] : '';
            }


            if (isset($args['temperature'])) {

                $NuevoControl->temperature = $args['temperature'] != '.' ? $args['temperature'] : '';
            }

            if (isset($args['tension'])) {

                $NuevoControl->tension = $args['tension'] != '.' ? $args['tension'] : '';
            }

            if (isset($args['mental'])) {

                $NuevoControl->mental = $args['mental'] != '.' ? $args['mental'] : '';
            }


            if (isset($args['skin'])) {

                $NuevoControl->skin = $args['skin'] != '.' ? $args['skin'] : '';
            }

            if (isset($args['pulm'])) {

                $NuevoControl->pulm = $args['pulm'] != '.' ? $args['pulm'] : '';
            }

            if (isset($args['abdomen'])) {

                $NuevoControl->abdomen = $args['abdomen'] != '.' ? $args['abdomen'] : '';
            }


            if (isset($args['extremities'])) {

                $NuevoControl->extremities = $args['extremities'] != '.' ? $args['extremities'] : '';
            }

            if (isset($args['neurol'])) {

                $NuevoControl->neurol = $args['neurol'] != '.' ? $args['neurol'] : '';
            }
            if (isset($args['head'])) {

                $NuevoControl->head = $args['head'] != '.' ? $args['head'] : '';
            }

            $NuevoControl->save();
        } else {

            // make user with data

            $NuevoControl = NuevoControl::create([

                'identification' => $record->identification,
 
                'tests' => isset($args['tests']) && $args['tests'] != '.' ?urldecode($args['tests']) : '',
                
                'behavior' => isset($args['behavior']) && $args['behavior'] != '.' ?urldecode($args['behavior']) : '',
                
                'process' => isset($args['process']) && $args['process'] != '.' ?urldecode($args['process']) : '',
                
                'motive' => isset($args['motive']) && $args['motive'] != '.' ?urldecode($args['motive']) : '',
                
                'family' => isset($args['family']) && $args['family'] != '.' ?urldecode($args['family']) : '',
                
                'allergies' => isset($args['allergies']) && $args['allergies'] != '.' ?urldecode($args['allergies']) : '',
                
                'diagnostic' => isset($args['diagnostic']) && $args['diagnostic'] != '.' ?urldecode($args['diagnostic']) : '',
                
                'toxicologist' => isset($args['toxicologist']) && $args['toxicologist'] != '.' ?urldecode($args['toxicologist']) : '',
                
                'occupational' => isset($args['occupational']) && $args['occupational'] != '.' ?urldecode($args['occupational']) : '',
                
                'diagnostic_type' => isset($args['diagnostic_type']) && $args['diagnostic_type'] != '.' ?urldecode($args['diagnostic_type']) : '',
                
                'external_cause' => isset($args['external_cause']) && $args['external_cause'] != '.' ?urldecode($args['external_cause']) : '',
                
                'purpose' => isset($args['purpose']) && $args['purpose'] != '.' ?urldecode($args['purpose']) : '',
                
                'procedure' => isset($args['procedure']) && $args['procedure'] != '.' ?urldecode($args['procedure']) : '',
                
                'authorization_number' => isset($args['authorization_number']) && $args['authorization_number'] != '.' ?urldecode($args['authorization_number']) : '',
                
                'surgical' => isset($args['surgical']) && $args['surgical'] != '.' ?urldecode($args['surgical']) : '',
                
                'current_illness' => isset($args['current_illness']) && $args['current_illness'] != '.' ?urldecode($args['current_illness']) : '',
                
                'pathological' => isset($args['pathological']) && $args['pathological'] != '.' ?urldecode($args['pathological']) : '',
                
                'notes' => isset($args['notes']) && $args['notes'] != '.' ?urldecode($args['notes']) : '',
                
                'diagnosis' => isset($args['diagnosis']) && $args['diagnosis'] != '.' ?urldecode($args['diagnosis']) : '',
                
                'pharmacological' => isset($args['pharmacological']) && $args['pharmacological'] != '.' ?urldecode($args['pharmacological']) : '',
                
                'physical_ta' => isset($args['physical_ta']) && $args['physical_ta'] != '.' ?urldecode($args['physical_ta']) : '',
                
                'physical_fc' => isset($args['physical_fc']) && $args['physical_fc'] != '.' ?urldecode($args['physical_fc']) : '',
                
                'weight' => isset($args['weight']) && $args['weight'] != '.' ?urldecode($args['weight']) : '',
                
                'height' => isset($args['height']) && $args['height'] != '.' ?urldecode($args['height']) : '',
                       
                'head' => isset($args['head']) && $args['head'] != '.' ?urldecode($args['head']) : '',
                
                'neck' => isset($args['neck']) && $args['neck'] != '.' ?urldecode($args['neck']) : '',
                
                'thorax' => isset($args['thorax']) && $args['thorax'] != '.' ?urldecode($args['thorax']) : '',
                
                'pregnancy' => isset($args['pregnancy']) && $args['pregnancy'] != '.' ?urldecode($args['pregnancy']) : '',
                
                'exams' => isset($args['exams']) && $args['exams'] != '.' ?urldecode($args['exams']) : '',
                
                'sao' => isset($args['sao']) && $args['sao'] != '.' ?urldecode($args['sao']) : '',
                
                'temperature' => isset($args['temperature']) && $args['temperature'] != '.' ?urldecode($args['temperature']) : '',
                
                'tension' => isset($args['tension']) && $args['tension'] != '.' ?urldecode($args['tension']) : '',
                
                'mental' => isset($args['mental']) && $args['mental'] != '.' ?urldecode($args['mental']) : '',
                
                'skin' => isset($args['skin']) && $args['skin'] != '.' ?urldecode($args['skin']) : '',
                
                'pulm' => isset($args['pulm']) && $args['pulm'] != '.' ?urldecode($args['pulm']) : '',
                
                'abdomen' => isset($args['abdomen']) && $args['abdomen'] != '.' ?urldecode($args['abdomen']) : '',
                
                'extremities' => isset($args['extremities']) && $args['extremities'] != '.' ?urldecode($args['extremities']) : '',
                
                'neurol' => isset($args['neurol']) && $args['neurol'] != '.' ?urldecode($args['neurol']) : '',
                

            ]);
        }



        return $NuevoControl;
    }
}
