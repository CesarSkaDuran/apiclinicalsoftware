<?php

namespace HC\Histories\AppPatient\Domain;

final class AppPatientEntity
{
    private ?Int $id;
    private Int $user_id;
    private String $name;
    private String $identity;
    private ?String $phone;
    private String $birth_date;
    private String $sex;
    private ?String $avatar_url;
    private Int $status;

    private int $DEFAULT_STATUS = 1;

    public function __construct(?Int $id, Int $user_id, String $name, String $identity, ?String $phone, String $birth_date, String $sex, ?String $avatar_url, ?Int $status)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->identity = $identity;
        $this->phone = $phone;
        $this->birth_date = $birth_date;
        $this->sex = $sex;
        $this->avatar_url = $avatar_url;
        $this->status = $status != null ? $status : $this->DEFAULT_STATUS;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? $data['id'] : null,
            $data['user_id'],
            $data['name'],
            $data['identity'],
            isset($data['phone']) ? $data['phone'] : null,
            $data['birth_date'],
            $data['sex'],
            isset($data['avatar_url']) ? $data['avatar_url'] : null,
            isset($data['status']) ? $data['status'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'identity' => $this->identity,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'avatar_url' => $this->avatar_url,
            'status' => $this->status
        ];
    }

    public function id(): Int
    {
        return $this->id;
    }

    public function user_id(): Int
    {
        return $this->user_id;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function identity(): String
    {
        return $this->identity;
    }

    public function phone(): String
    {
        return $this->phone;
    }

    public function birth_date(): String
    {
        return $this->birth_date;
    }

    public function sex(): String
    {
        return $this->sex;
    }

    public function avatar_url(): ?String
    {
        return $this->avatar_url;
    }

    public function status(): Int
    {
        return $this->status;
    }




}
