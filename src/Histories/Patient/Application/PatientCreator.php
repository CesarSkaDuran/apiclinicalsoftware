<?php

namespace HC\Histories\Patient\Application;

use HC\Histories\Patient\Domain\PatientEntity;
use HC\Histories\Patient\Domain\PatientRepository;

class PatientCreator
{
    private PatientRepository $repository;

    public function __construct(PatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(PatientEntity $entity): Int
    {
        return $this->repository->create($entity);
    }
}
