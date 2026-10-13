<?php

namespace HC\Histories\Doctor\Domain;

class DoctorEntityCollection
{
    private array $collection;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public static function fromArray(array $data): self
    {
        $newCollection = array_map(function($doctorData) {
            return DoctorEntity::fromArray($doctorData);
        }, $data);

        return new self(
            $newCollection
        );
    }

    public function toArray(): array
    {
        return array_map(function($doctorEntity) {
            return $doctorEntity->toArray();
        }, $this->collection);
    }
}
