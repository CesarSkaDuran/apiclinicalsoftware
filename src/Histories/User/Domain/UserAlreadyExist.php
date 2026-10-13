<?php


namespace HC\Histories\User\Domain;


use HC\Shared\Domain\DomainError;

final class UserAlreadyExist extends DomainError
{
    private String $userEmail;

    public function __construct(String $userEmail)
    {
        $this->userEmail = $userEmail;

        parent::__construct();
    }


    public function errorCode(): string
    {
        return 'user_email_already_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('There is a created user with same email: %s', $this->userEmail);
    }
}
