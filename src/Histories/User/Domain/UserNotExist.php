<?php

namespace HC\Histories\User\Domain;

use HC\Shared\Domain\DomainError;

class UserNotExist extends DomainError
{
    private Int $userId;

    public function __construct(Int $userId)
    {
        $this->userId = $userId;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'user_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('User with id <%s> not exist', $this->userId);
    }
}
