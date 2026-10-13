<?php







namespace App\GraphQL\Mutation;







use GraphQL;



use GraphQL\Type\Definition\Type;



use Folklore\GraphQL\Support\Mutation;



use Sinergi\BrowserDetector\Os;



use Torann\GeoIP\Facades\GeoIP;



use Illuminate\Support\Facades\Hash;



use App\RecordMedicine;







/**



 * CreateFileMutation



 */







class SaveRecordMedicineMutation extends Mutation



{



    protected $attributes = [



        'name' => 'create or update record'



    ];







    public function type()



    {



        return GraphQL::type('recordMedicine');



    }







    public function args()



    {



        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'medicine_id' => ['name' => 'medicine_id', 'type' => Type::int()],

            'dose' => ['name' => 'dose', 'type' => Type::string()],

            'measure' => ['name' => 'measure', 'type' => Type::string()],

            'frequency' => ['name' => 'frequency', 'type' => Type::string()],

            'duration' => ['name' => 'duration', 'type' => Type::string()],

            'quantity' => ['name' => 'quantity', 'type' => Type::string()],

            'administration' => ['name' => 'administration', 'type' => Type::string()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],

        ];



    }







    public function rules()



    {



        return [];



    }







    public function resolve($root, $args)



    {

        $currentUser = auth('api')->user();
        
        if (isset($args['delete']) && isset($args['id'])) {
            $deleted = RecordMedicine::where('id', $args['id'])->delete();
            return $deleted;
        }


        if (isset($args['id'])) {



            $recordMedicine = RecordMedicine::where('id', $args['id'])->first();



        } else {



            $recordMedicine = null;



        }







        if ($recordMedicine) {

            if (isset($args['record_id'])) {
                $recordMedicine->record_id = $args['record_id'];
            }

            if (isset($args['medicine_id'])) {
                $recordMedicine->medicine_id = $args['medicine_id'];
            }

            if (isset($args['dose'])) {
                $recordMedicine->dose = $args['dose'];
            }

            if (isset($args['measure'])) {
                $recordMedicine->measure = $args['measure'];
            }

            if (isset($args['frequency'])) {
                $recordMedicine->frequency = $args['frequency'];
            }

            if (isset($args['duration'])) {
                $recordMedicine->duration = $args['duration'];
            }

            if (isset($args['quantity'])) {
                $recordMedicine->quantity = $args['quantity'];
            }

            if (isset($args['administration'])) {
                $recordMedicine->administration = $args['administration'];
            }


            $recordMedicine->save();            



        } else {

            // make user with data

            $recordMedicine = RecordMedicine::create([
                'record_id' => $args['record_id'],
                'medicine_id' => $args['medicine_id'],
                'dose' => $args['dose'],
                'measure' => $args['measure'],
                'frequency' => $args['frequency'],
                'duration' => $args['duration'],
                'quantity' => $args['quantity'],
                'administration' => $args['administration']
            ]);

        }
        
        return $recordMedicine;



    }







}