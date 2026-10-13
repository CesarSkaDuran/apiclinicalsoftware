<?php

namespace HC\Histories\AppPatient\Application;

use HC\Histories\AppPatient\Domain\AppPatientEntity;
use HC\Histories\AppPatient\Domain\AppPatientRepository;

class AppPatientCreator
{
    private AppPatientRepository $repository;

    public function __construct(AppPatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(AppPatientEntity $entity): Int
    {
        return $this->repository->create($entity);
    }
}
