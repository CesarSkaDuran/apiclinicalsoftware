<?php

namespace HC\Histories\Doctor\Infrastructure;

use App\Doctor;
use HC\Histories\Doctor\Domain\DoctorEntityCollection;
use HC\Histories\Doctor\Domain\DoctorRepository;

class EloquentDoctorRepository implements DoctorRepository
{
    private Doctor $model;
    private int $AVAILABLE_STATUS = 1;

    public function __construct()
    {
        $this->model = new Doctor();
    }

    public function findAll(): ?DoctorEntityCollection
    {
        $data = $this->model->where('status', $this->AVAILABLE_STATUS)->get();

        return DoctorEntityCollection::fromArray($data ? $data->toArray() : []);
    }
}
