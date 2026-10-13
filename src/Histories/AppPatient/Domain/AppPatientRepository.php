<?php

namespace HC\Histories\AppPatient\Domain;

interface AppPatientRepository
{
    public function find(Int $id): ?AppPatientEntity;
    public function findByUser(Int $userId): ?AppPatientEntity;
    public function create(AppPatientEntity $entity): Int;
}
