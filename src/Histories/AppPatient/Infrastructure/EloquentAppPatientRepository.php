<?php

namespace HC\Histories\AppPatient\Infrastructure;

use App\AppPatient;
use HC\Histories\AppPatient\Domain\AppPatientEntity;
use HC\Histories\AppPatient\Domain\AppPatientRepository;

class EloquentAppPatientRepository implements AppPatientRepository
{
    private AppPatient $model;

    public function __construct()
    {
        $this->model = new AppPatient();
    }

    public function find(Int $id): ?AppPatientEntity
    {
        $response = $this->model->where('id', $id)->first();

        return $response ? AppPatientEntity::fromArray($response->toArray()) : null;
    }

    public function findByUser(Int $userId): ?AppPatientEntity
    {
        $response = $this->model->where('user_id', $userId)->first();

        return $response ? AppPatientEntity::fromArray($response->toArray()) : null;
    }

    public function create(AppPatientEntity $entity): Int
    {
        $created = $this->model->create($entity->toArray());

        return $created->id;
    }
}
