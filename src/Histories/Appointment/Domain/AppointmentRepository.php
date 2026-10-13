<?php

namespace HC\Histories\Appointment\Domain;

interface AppointmentRepository
{
    public function create(AppointmentEntity $entity): Int;
    public function findByDoctor(Int $doctorId, ?String $month, ?String $search): ?AppointmentEntityCollection;
    public function findByAppUser(Int $userId, ?String $month, ?String $search): ?AppointmentEntityCollection;
//    public function find(Int $id): ?AppointmentEntity;
}
