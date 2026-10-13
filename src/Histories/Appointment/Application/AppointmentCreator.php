<?php


namespace HC\Histories\Appointment\Application;


use HC\Histories\Appointment\Domain\AppointmentEntity;
use HC\Histories\Appointment\Domain\AppointmentRepository;

class AppointmentCreator
{
    private AppointmentRepository $repository;

    public function __construct(AppointmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(AppointmentEntity $entity): Int
    {
        $response = $this->repository->create($entity);

        return $response;
    }
}
