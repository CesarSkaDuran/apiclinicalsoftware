<?php

namespace HC\Histories\Doctor\Domain;

interface DoctorRepository
{
    public function findAll(): ?DoctorEntityCollection;
}
