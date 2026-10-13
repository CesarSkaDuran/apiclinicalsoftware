<?php

namespace HC\Asia\Incomes\Domain;

final class IncomeEntity
{
    private Int $id;
    private Int $user_id;
    private String $concept;
    private String $date;
    private Float $value;
    private Int $status;

    public function __construct(Int $id, Int $user_id, String $concept, String $date, Float $value, Int $status)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->concept = $concept;
        $this->date = $date;
        $this->value = $value;
        $this->status = $status;
    }

    public function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['user_id'],
            $data['concept'],
            $data['date'],
            $data['value'],
            $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'concept' => $this->concept,
            'date' => $this->date,
            'value' => $this->value,
            'status' => $this->status
        ];
    }

    public function id(): Int
    {
        return $this->id;
    }

    public function userId(): Int
    {
        return $this->user_id;
    }

    public function concept(): String
    {
        return $this->concept;
    }

    public function date(): String
    {
        return $this->date;
    }

    public function value(): Float
    {
        return $this->value;
    }

    public function status(): Int
    {
        return $this->status;
    }
}
