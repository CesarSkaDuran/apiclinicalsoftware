<?php

namespace HC\Histories\Doctor\Application;

use HC\Histories\Doctor\Domain\DoctorEntityCollection;
use HC\Histories\Doctor\Domain\DoctorRepository;

class FindAllDoctors
{
    private DoctorRepository $repository;

    public function __construct(DoctorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): ?DoctorEntityCollection
    {
        return $this->repository->findAll();
    }
}
