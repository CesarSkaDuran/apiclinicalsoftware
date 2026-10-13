<?php

namespace HC\Histories\Patient\Application;

use HC\Histories\Patient\Domain\PatientEntity;
use HC\Histories\Patient\Domain\PatientRepository;

class PatientFinderByUser
{
    private PatientRepository $repository;

    public function __construct(PatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Int $userId): ?PatientEntity
    {
        return $this->repository->findByUser($userId);
    }
}
