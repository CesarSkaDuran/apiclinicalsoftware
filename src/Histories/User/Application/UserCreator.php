<?php


namespace HC\Histories\User\Application;


use HC\Histories\User\Domain\UserEntity;
use HC\Histories\User\Domain\UserRepository;

class UserCreator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserEntity $entity): Int
    {
        return $this->repository->create($entity);
    }
}
