<?php

namespace HC\Histories\Patient\Infrastructure;

use App\Patient;
use HC\Histories\Patient\Domain\PatientEntity;
use HC\Histories\Patient\Domain\PatientRepository;

class EloquentPatientRepository implements PatientRepository
{
    private Patient $model;

    public function __construct()
    {
        $this->model = new Patient();
    }

    public function find(Int $id): ?PatientEntity
    {
        $response = $this->model->where('id', $id)->first();

        return $response ? PatientEntity::fromArray($response->toArray()) : null;
    }

    public function findByUser(Int $userId): ?PatientEntity
    {
        $response = $this->model->where('user_id', $userId)->first();

        return $response ? PatientEntity::fromArray($response->toArray()) : null;
    }

    public function create(PatientEntity $entity): Int
    {
        $created = $this->model->create($entity->toArray());

        return $created->id;
    }
}
