<?php


namespace HC\Histories\User\Application;


use HC\Histories\User\Domain\UserEntity;
use HC\Histories\User\Domain\UserRepository;

class UserFinder
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Int $id): ?UserEntity
    {
        return $this->repository->find($id);
    }
}
