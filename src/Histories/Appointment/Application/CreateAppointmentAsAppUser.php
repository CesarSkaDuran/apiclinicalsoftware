<?php

namespace HC\Histories\Appointment\Application;

use HC\Histories\Appointment\Domain\AppointmentEntity;
use HC\Histories\Appointment\Domain\AppointmentRepository;

class CreateAppointmentAsAppUser
{
    private AppointmentCreator $creator;

    public function __construct(AppointmentRepository $repository)
    {
        $this->creator = new AppointmentCreator($repository);
    }

    public function execute(array $data): Int
    {
        return $this->creator->execute(AppointmentEntity::fromArray($data));
    }
}
