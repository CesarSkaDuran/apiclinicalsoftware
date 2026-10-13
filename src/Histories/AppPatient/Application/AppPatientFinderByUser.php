<?php

namespace HC\Histories\AppPatient\Application;

use HC\Histories\AppPatient\Domain\AppPatientEntity;
use HC\Histories\AppPatient\Domain\AppPatientRepository;

class AppPatientFinderByUser
{
    private AppPatientRepository $repository;

    public function __construct(AppPatientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Int $userId): ?AppPatientEntity
    {
        return $this->repository->findByUser($userId);
    }
}
