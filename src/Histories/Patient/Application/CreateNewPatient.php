<?php

namespace HC\Histories\Patient\Application;

use HC\Histories\Patient\Domain\PatientEntity;
use HC\Histories\Patient\Domain\PatientRepository;

class CreateNewPatient
{
    private PatientCreator $patientCreator;

    public function __construct(PatientRepository $repository)
    {
        $this->patientCreator = new PatientCreator($repository);
    }

    public function execute(array $dataArray): Int
    {
        $this->validateUserEmailNotExist($dataArray['email']);

        $entity = PatientEntity::fromArray($dataArray);

        return $this->patientCreator->execute($entity);
    }

    private function validateUserEmailNotExist(String $email): void
    {
    }
}
