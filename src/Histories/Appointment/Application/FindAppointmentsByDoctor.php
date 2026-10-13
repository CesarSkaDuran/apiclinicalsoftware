<?php

namespace HC\Histories\Appointment\Application;

use HC\Histories\Appointment\Domain\AppointmentEntityCollection;
use HC\Histories\Appointment\Domain\AppointmentRepository;

class FindAppointmentsByDoctor
{
    private AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Int $userId, ?String $month, ?String $search): ?AppointmentEntityCollection
    {
        return $this->repository->findByDoctor($userId, $month, $search);
    }
}
