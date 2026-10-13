<?php

namespace HC\Histories\Appointment\Application;

use HC\Histories\Appointment\Domain\AppointmentEntityCollection;
use HC\Histories\Appointment\Domain\AppointmentRepository;

class FindAppointmentsByAppUser
{
    private AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Int $appUserId, ?String $month, ?String $search): ?AppointmentEntityCollection
    {
        return $this->repository->findByAppUser($appUserId, $month, $search);
    }
}
