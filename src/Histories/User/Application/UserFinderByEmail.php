<?php


namespace HC\Histories\User\Application;


use HC\Histories\User\Domain\UserEntity;
use HC\Histories\User\Domain\UserRepository;

class UserFinderByEmail
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(String $email): ?UserEntity
    {
        $result = $this->repository->findByEmail($email);

        return $result;
    }
}
