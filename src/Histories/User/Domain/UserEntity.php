<?php

namespace HC\Histories\User\Domain;

class UserEntity
{
    private ?int $id;
    private Int $role_id;
    private String $name;
    private String $email;
    private Int $user_type;
    private Int $status;
    private Int $verified;
    private ?String $password;
    private ?String $chat_id;

    private int $DEFAULT_STATUS = 1;
    private int $DEFAULT_VERIFIED = 0;

    public function __construct(?Int $id, Int $role_id, String $name, String $email, Int $user_type, ?Int $status, ?bool $verified, ?String $password = null, ?String $chat_id = '.')
    {
        $this->id = $id;
        $this->role_id = $role_id;
        $this->name = $name;
        $this->email = $email;
        $this->user_type = $user_type;
        $this->status = $status != null ? $status : $this->DEFAULT_STATUS;
        $this->verified = $verified != null ? $verified : $this->DEFAULT_VERIFIED;
        $this->password = $password;
        $this->chat_id = $chat_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? $data['id'] : null,
            $data['role_id'],
            $data['name'],
            $data['email'],
            $data['user_type'],
            isset($data['status']) ? $data['status'] : null,
            isset($data['verified']) ? $data['verified'] : null,
            isset($data['password']) ? $data['password'] : null,
            isset($data['chat_id']) ? $data['chat_id'] : '.',
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'role_id' => $this->role_id,
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->user_type,
            'status' => $this->status,
            'is_verified' => $this->verified,
            'password' => $this->password,
            'chat_id' => $this->chat_id,
        ];
    }

    public function id(): Int
    {
        return $this->id;
    }

    public function role_id(): Int
    {
        return $this->role_id;
    }

    public function name(): String
    {
        return $this->name;
    }


    public function email(): String
    {
        return $this->email;
    }

    public function user_type(): Int
    {
        return $this->user_type;
    }

    public function status(): Int
    {
        return $this->status;
    }

    public function verified(): bool
    {
        return $this->verified;
    }

    public function chat_id(): String
    {
        return $this->chat_id;
    }
}
