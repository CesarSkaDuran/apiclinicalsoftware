<?php

namespace HC\Histories\Appointment\Domain;

final class AppointmentEntityCollection
{
    private array $collection;

    public function __construct(array $collection)
    {
        $this->collection = $collection;
    }

    public static function fromArray(array $data): self
    {
        $newCollection = array_map(function($appointmentData) {
            return AppointmentEntity::fromArray($appointmentData);
        }, $data);

        return new self(
            $newCollection
        );
    }

    public function toArray(): array
    {
        return array_map(function($appointmentEntity) {
            return $appointmentEntity->toArray();
        }, $this->collection);
    }
}
