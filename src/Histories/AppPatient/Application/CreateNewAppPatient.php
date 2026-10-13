<?php

namespace HC\Histories\AppPatient\Application;

use HC\Histories\AppPatient\Domain\AppPatientEntity;
use HC\Histories\AppPatient\Domain\AppPatientRepository;

class CreateNewAppPatient
{
    private AppPatientCreator $patientCreator;

    public function __construct(AppPatientRepository $repository)
    {
        $this->patientCreator = new AppPatientCreator($repository);
    }

    public function execute(array $dataArray): Int
    {
        $this->validateUserEmailNotExist($dataArray['email']);

        $entity = AppPatientEntity::fromArray($dataArray);

        return $this->patientCreator->execute($entity);
    }

    private function validateUserEmailNotExist(String $email): void
    {
    }
}
