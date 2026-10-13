<?php

namespace HC\Histories\Patient\Domain;

interface PatientRepository
{
    public function find(Int $id): ?PatientEntity;
    public function findByUser(Int $userId): ?PatientEntity;
    public function create(PatientEntity $entity): Int;
}
