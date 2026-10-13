<?php

namespace HC\Histories\User\Domain;

interface UserRepository
{
    public function find(Int $id): ?UserEntity;
    public function findByEmail(String $email): ?UserEntity;
    public function create(UserEntity $entity): Int;
}
