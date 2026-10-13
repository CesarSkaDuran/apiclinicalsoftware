<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\RecordPhysical;

use App\Record;



/**

 * CreateFileMutation

 */



class SavePhysicalMutation extends Mutation

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

            'physical_ta' => ['name' => 'physical_ta', 'type' => Type::string()],

            'physical_fc' => ['name' => 'physical_fc', 'type' => Type::string()],

            'weight' => ['name' => 'weight', 'type' => Type::string()],

            'otros' => ['name' => 'otros', 'type' => Type::string()],

            'imc' => ['name' => 'imc', 'type' => Type::string()],

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
            
            'ta' => ['name' => 'ta', 'type' => Type::string()],
            
            'spo2' => ['name' => 'spo2', 'type' => Type::string()],
            
            'neurol' => ['name' => 'neurol', 'type' => Type::string()],
            
            'snc' => ['name' => 'snc', 'type' => Type::string()],
            
            'geni' => ['name' => 'geni', 'type' => Type::string()],
            
            'gluteos' => ['name' => 'gluteos', 'type' => Type::string()],

        ];

    }



    public function rules()

    {

        return [

            'record_id' => ['required'],

            'physical_ta' => ['required']

        ];

    }



    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();

        

        $record = Record::where('identification', $args['record_id'])->first();



        if (!$record) {

            abort(404, 'Record not found');

        }



        $recordPhysical = $record->physical;



        if ($recordPhysical) {
            if (isset($args['physical_ta'])) {
                $recordPhysical->physical_ta = $args['physical_ta'];
            }

            if (isset($args['physical_fc'])) {
                $recordPhysical->physical_fc = $args['physical_fc'] != '.' ? $args['physical_fc'] : '';
            }

            if (isset($args['weight'])) {
                $recordPhysical->weight = $args['weight'] != '.' ? $args['weight'] : '';
            }

            if (isset($args['otros'])) {
                $recordPhysical->otros = $args['otros'] != '.' ? $args['otros'] : '';
            }

            if (isset($args['ta'])) {
                $recordPhysical->ta = $args['ta'] != '.' ? $args['ta'] : '';
            }

            if (isset($args['spo2'])) {
                $recordPhysical->spo2 = $args['spo2'] != '.' ? $args['spo2'] : '';
            }

            if (isset($args['imc'])) {
                $recordPhysical->imc = $args['imc'] != '.' ? $args['imc'] : '';
            }

            if (isset($args['height'])) {
                $recordPhysical->height = $args['height'] != '.' ? $args['height'] : '';
            }

            if (isset($args['head'])) {
                $recordPhysical->head = $args['head'] != '.' ? $args['head'] : '';
            }

            if (isset($args['neck'])) {
                $recordPhysical->neck = $args['neck'] != '.' ? $args['neck'] : '';
            }

            if (isset($args['thorax'])) {
                $recordPhysical->thorax = $args['thorax'] != '.' ? $args['thorax'] : '';
            }

            if (isset($args['pregnancy'])) {
                $recordPhysical->pregnancy = $args['pregnancy'] != '.' ? $args['pregnancy'] : '';
            }

            if (isset($args['exams'])) {
                $recordPhysical->exams = $args['exams'];
            }

            if(isset($args['sao'])) {
                $recordPhysical->sao = $args['sao'];
            }

            if(isset($args['temperature'])) {
                $recordPhysical->temperature = $args['temperature'];
            }

            if(isset($args['tension'])) {
                $recordPhysical->tension = $args['tension'];
            }

            if(isset($args['mental'])) {
                $recordPhysical->mental = $args['mental'];
            }

            if(isset($args['skin'])) {
                $recordPhysical->skin = $args['skin'];
            }

            if(isset($args['pulm'])) {
                $recordPhysical->pulm = $args['pulm'];
            }

            if(isset($args['abdomen'])) {
                $recordPhysical->abdomen = $args['abdomen'];
            }

            if(isset($args['extremities'])) {
                $recordPhysical->extremities = $args['extremities'];
            }

            if(isset($args['neurol'])) {
                $recordPhysical->neurol = $args['neurol'];
            }

            if (isset($args['snc'])) {
                $recordPhysical->snc = $args['snc'];
            }

            if (isset($args['gluteos'])) {
                $recordPhysical->gluteos = $args['gluteos'];
            }

            if (isset($args['geni'])) {
                $recordPhysical->geni = $args['geni'];
            }

            $recordPhysical->save();            

        } else {

            // make user with data

            $recordPhysical = RecordPhysical::create([

                'record_id' => $record->identification,

                'physical_ta' => $args['physical_ta'],

                'physical_fc' => isset($args['physical_fc']) && $args['physical_fc'] != '.' ?  $args['physical_fc'] : null,

                'weight' => isset($args['weight']) && $args['weight'] != '.' ?  $args['weight'] : null,

                'otros' => isset($args['otros']) && $args['otros'] != '.' ?  $args['otros'] : null,

                'imc' => isset($args['imc']) && $args['imc'] != '.' ?  $args['imc'] : null,

                'ta' => isset($args['ta']) && $args['ta'] != '.' ?  $args['ta'] : null,

                'spo2' => isset($args['spo2']) && $args['spo2'] != '.' ?  $args['spo2'] : null,

                'height' => isset($args['height']) && $args['height'] != '.' ?  $args['height'] : null,

                'head' => isset($args['head']) && $args['head'] != '.' ?  $args['head'] : null,

                'neck' => isset($args['neck']) && $args['neck'] != '.' ?  $args['neck'] : null,

                'thorax' => isset($args['thorax']) && $args['thorax'] != '.' ?  $args['thorax'] : null,

                'pregnancy' => isset($args['pregnancy']) && $args['pregnancy'] != '.' ?  $args['pregnancy'] : null,
                'exams' => isset($args['exams']) && $args['exams'] != '.' ?  $args['exams'] : null,
                'sao' => isset($args['sao']) && $args['sao'] != '.' ? $args['sao'] : null,
                'temperature' => isset($args['temperature']) && $args['temperature'] != '.' ? $args['temperature'] : null,
                'tension' => isset($args['tension']) && $args['tension'] != '.' ? $args['tension'] : null,
                'mental' => isset($args['mental']) && $args['mental'] != '.' ? $args['mental'] : null,
                'skin' => isset($args['skin']) && $args['skin'] != '.' ? $args['skin'] : null,
                'pulm' => isset($args['pulm']) && $args['pulm'] != '.' ? $args['pulm'] : null,
                'abdomen' => isset($args['abdomen']) && $args['abdomen'] != '.' ? $args['abdomen'] : null,
                'extremities' => isset($args['extremities']) && $args['extremities'] != '.' ? $args['extremities'] : null,
                'neurol' => isset($args['neurol']) && $args['neurol'] != '.' ? $args['neurol'] : null,


                'geni' => isset($args['geni']) && $args['geni'] != '.' ? $args['geni'] : null,
                'gluteos' => isset($args['gluteos']) && $args['gluteos'] != '.' ? $args['gluteos'] : null,
                'snc' => isset($args['snc']) && $args['snc'] != '.' ? $args['snc'] : null,

            ]);

        }



        return $record;

    }



}



