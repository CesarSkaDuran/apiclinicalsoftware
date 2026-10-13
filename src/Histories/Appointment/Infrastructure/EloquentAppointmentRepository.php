<?php

namespace HC\Histories\Appointment\Infrastructure;

use App\Appointment;
use HC\Histories\Appointment\Domain\AppointmentEntity;
use HC\Histories\Appointment\Domain\AppointmentEntityCollection;
use HC\Histories\Appointment\Domain\AppointmentRepository;

class EloquentAppointmentRepository implements AppointmentRepository

{
    private Appointment $model;

    public function __construct()
    {
        $this->model = new Appointment();
    }

    public function create(AppointmentEntity $entity): Int
    {
        $data = $this->model->create($entity->toArray());

        return $data->id;
    }

    public function findByDoctor(Int $userId, ?String $month, ?String $search): ?AppointmentEntityCollection
    {
        $data = $this->model->where('user_id', $userId)->get();

        return AppointmentEntityCollection::fromArray($data ? $data->toArray() : []);
    }

    public function findByAppUser(Int $userId, ?String $month, ?String $search): ?AppointmentEntityCollection
    {
        $data = $this->model->where('app_user_id', $userId)->get();

        return AppointmentEntityCollection::fromArray($data ? $data->toArray() : []);
    }
}
