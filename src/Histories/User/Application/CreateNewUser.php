<?php

namespace HC\Histories\User\Application;

use HC\Histories\User\Domain\UserAlreadyExist;
use HC\Histories\User\Domain\UserEntity;
use HC\Histories\User\Domain\UserRepository;

class CreateNewUser
{
    private UserCreator $userCreator;
    private UserFinderByEmail $userFinder;

    public function __construct(UserRepository $repository)
    {
        $this->userCreator = new UserCreator($repository);
        $this->userFinder = new UserFinderByEmail($repository);
    }

    public function execute(array $dataArray): Int
    {
        $this->validateUserEmailNotExist($dataArray['email']);

        $entity = UserEntity::fromArray($dataArray);

        return $this->userCreator->execute($entity);
    }

    private function validateUserEmailNotExist(String $email): void
    {
        $match = $this->userFinder->execute($email);

        if ($match) {
            throw new UserAlreadyExist($email);
        }
    }
}
