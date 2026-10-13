<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Record;
use App\Patient;
use App\User;

use HC\Histories\AppPatient\Application\CreateNewAppPatient;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;
use HC\Histories\User\Application\CreateNewUser;
use HC\Histories\User\Domain\UserAlreadyExist;
use HC\Histories\User\Infrastructure\EloquentUserRepository;

/**
 * CreateFileMutation
 */

class SavePatientMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update patient'
    ];

    public function type()
    {
        return GraphQL::type('patient');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'identification' => ['name' => 'identification', 'type' => Type::string()],
            'position' => ['name' => 'position', 'type' => Type::string()],
            'civil_status' => ['name' => 'civil_status', 'type' => Type::string()],
            'TipoDocumento' => ['name' => 'TipoDocumento', 'type' => Type::string()],
            'sex' => ['name' => 'sex', 'type' => Type::string()],
            'birth_date' => ['name' => 'birth_date', 'type' => Type::string()],
            'imagen' => ['name' => 'imagen', 'type' => Type::string()],
            'phone' => ['name' => 'phone', 'type' => Type::string()],
            'address' => ['name' => 'address', 'type' => Type::string()],
            'grupo_sanguineo' => ['name' => 'grupo_sanguineo', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'partner_name' => ['name' => 'partner_name', 'type' => Type::string()],
            'partner_profession' => ['name' => 'partner_profession', 'type' => Type::string()],
            'eps' => ['name' => 'eps', 'type' => Type::int()],
            'arl' => ['name' => 'arl', 'type' => Type::int()],
            'fecha' => ['name' => 'fecha', 'type' => Type::string()],
            'pension' => ['name' => 'pension', 'type' => Type::int()],
            'make_record' => ['name' => 'make_record', 'type' => Type::int()],
            'create_user' => ['name' => 'create_user', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            // 'name' => ['required'],
            // 'identification' => ['required']
        ];
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();

        if (isset($args['id'])) {
            $patient = Patient::where('id', $args['id'])->first();
        } else {
            // new user
            $patient = Patient::where('identification', $args['identification'])->first();

            // validations
        }        

        if ($patient) {
            if (isset($args['name'])) {
                $patient->name = $args['name'];
            }

            if (isset($args['identification'])) {
                // change all records reference
                $records = Record::where('patient_id', $patient->identification)->get();
                foreach ($records as $record) {
                    $record->patient_id = $args['identification'];
                    $record->save();
                }

                $patient->identification = $args['identification'];
            }

            if (isset($args['position'])) {
                $patient->position = $args['position'];
            }

            if (isset($args['imagen'])) {
                $patient->imagen = $args['imagen'];
            }

            if (isset($args['civil_status'])) {
                $patient->civil_status = $args['civil_status'];
            }

            if (isset($args['TipoDocumento'])) {
                $patient->TipoDocumento = $args['TipoDocumento'];
            }
            
            if (isset($args['sex'])) {
                $patient->sex = $args['sex'];
            }

            if (isset($args['birth_date'])) {
                $patient->birth_date = $args['birth_date'];
            }

            if (isset($args['phone'])) {
                $patient->phone = $args['phone'];
            }

            if (isset($args['address'])) {
                $patient->address = isset($args['address']) ? $args['address'] : '';
            }

            if (isset($args['grupo_sanguineo'])) {
                $patient->grupo_sanguineo = isset($args['grupo_sanguineo']) ? $args['grupo_sanguineo'] : '';
            }

            if (isset($args['email'])) {
                $patient->email = isset($args['email']) ? $args['email'] : '';
            }

            if (isset($args['eps'])) {
                $patient->eps = $args['eps'];
            }

            if (isset($args['arl'])) {
                $patient->arl = $args['arl'];
            }

            if (isset($args['fecha'])) {
                $patient->fecha = $this->generateRandomString();
            }

            if (isset($args['pension'])) {
                $patient->pension = $args['pension'];
            }

            if (isset($args['partner_name'])) {
                $patient->partner_name = isset($args['partner_name']) ? $args['partner_name'] : '';
            }

            if (isset($args['partner_profession'])) {
                $patient->partner_profession = isset($args['partner_profession']) ? $args['partner_profession'] : '';
            }

            $patient->save();
        } else {
            // make user with data
            $patient = Patient::create([
                'user_id' => $currentUser->id,
                'name' => $args['name'],
                'identification' => $args['identification'],
                'position' => isset($args['position']) ? $args['position'] : '',
                'civil_status' => isset($args['civil_status']) ? $args['civil_status'] : '',
                'TipoDocumento' => isset($args['TipoDocumento']) ? $args['TipoDocumento'] : '',
                'sex' => isset($args['sex']) ? $args['sex'] : '',
                'birth_date' => isset($args['birth_date']) ? $args['birth_date'] : '',
                'phone' => isset($args['phone']) ? $args['phone'] : '',
                'address' => isset($args['address']) ? $args['address'] : '',
                'grupo_sanguineo' => isset($args['grupo_sanguineo']) ? $args['grupo_sanguineo'] : '',
                'email' => isset($args['email']) ? $args['email'] : '',
                'eps' => isset($args['eps']) ? $args['eps'] : null,
                'arl' => isset($args['arl']) ? $args['arl'] : null,
                'fecha' => isset($args['fecha']) ? $args['fecha'] : null,
                'pension' => isset($args['pension']) ? $args['pension'] : null,
                'partner_name' => isset($args['partner_name']) ? $args['partner_name'] : '',
                'partner_profession' => isset($args['partner_profession']) ? $args['partner_profession'] : ''
            ]);

            if (isset($args['make_record']) && $args['make_record'] == 1) {
                $record = Record::create([
                    'user_id' => $currentUser->id,
                    'patient_id' => $patient->identification,
                    'identification' => $patient->identification . '-1',
                ]);
            }

            if (isset($args['create_user']) && $args['create_user'] == 'true') {
                $data = [];

                $data['role_id'] = 0;
                $data['user_type'] = 3;
                $data['name'] = $args['name'];
                $data['email'] = $args['email'];
                $data['password'] = $args['identification'];
                $data['identity'] = $args['identification'];
                $data['phone'] = $args['phone'];
                $data['birth_date'] = $args['birth_date'];
                $data['sex'] = 'none';
                // $data['sex'] = $args['sex'];
                // $data['TipoDocumento'] = $args['TipoDocumento'];

                // try {
                    $newUserCreator = new CreateNewUser(new EloquentUserRepository());
                    $newAppPatientCreator = new CreateNewAppPatient(new EloquentAppPatientRepository());

                    $newUserId = $newUserCreator->execute($data);

                    $data['user_id'] = $newUserId;

                    $newAppPatientCreator->execute($data);
                    $user = User::where('id', $newUserId)->first();
                    $patient->chat_id = $user->chat_id;
                    $patient->save();
                // } catch (UserAlreadyExist $exception) {
                    // return response()->json(['error' => $exception->getMessage()], 409);
                // }
            }
        }

        return $patient;

    }

}

