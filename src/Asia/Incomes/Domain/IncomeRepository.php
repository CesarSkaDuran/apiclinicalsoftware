<?php

namespace HC\Asia\Incomes\Domain;

interface IncomeRepository
{
    public function find(Int $id): void;
    public function count(Int $id): void;
    public function save(array $data): void;
}
