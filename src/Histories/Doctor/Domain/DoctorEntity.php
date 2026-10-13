<?php

namespace HC\Histories\Doctor\Domain;

class DoctorEntity
{
    private ?Int $id;
    private Int $institution_id;
    private Int $office_id;
    private String $name;
    private String $specialization;
    private String $experience;
    private String $phone;
    private String $address;
    private String $avatar_url;
    private Float $consultation_price;
    private Float $in_place_price;
    private Float $virtual_price;
    private String $bio;
    private String $chat_id;
    private ?Int $status;

    private int $DEFAULT_STATUS = 1;

    public function __construct(?Int $id, Int $institution_id, Int $office_id, String $name, String $specialization, String $experience,String $phone,String $address, String $avatar_url, Float $consultation_price, String $in_place_price, String $virtual_price, String $bio, String $chat_id, ?Int $status)
    {
        $this->id = $id;
        $this->institution_id = $institution_id;
        $this->office_id = $office_id;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->experience = $experience;
        $this->phone = $phone;
        $this->address = $address;
        $this->avatar_url = $avatar_url;
        $this->consultation_price = $consultation_price;
        $this->in_place_price = $in_place_price;
        $this->virtual_price = $virtual_price;
        $this->bio = $bio;
        $this->chat_id = $chat_id;
        $this->status = $status != null ? $status : $this->DEFAULT_STATUS;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? $data['id'] : null,
            $data['institution_id'],
            $data['office_id'],
            $data['name'],
            $data['specialization'],
            $data['experience'],
            $data['phone'],
            $data['address'],
            $data['avatar_url'],
            $data['consultation_price'],
            $data['in_place_price'],
            $data['virtual_price'],
            $data['bio'],
            $data['chat_id'],
            isset($data['status']) ? $data['status'] : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'institution_id' => $this->institution_id,
            'office_id' => $this->office_id,
            'name' => $this->name,
            'specialization' => $this->specialization,
            'experience' => $this->experience,
            'phone' => $this->phone,
            'address' => $this->address,
            'avatar_url' => $this->avatar_url,
            'consultation_price' => $this->consultation_price,
            'in_place_price' => $this->in_place_price,
            'virtual_price' => $this->virtual_price,
            'bio' => $this->bio,
            'chat_id' => $this->chat_id,
            'status' => $this->status
        ];
    }

    public function id(): Int
    {
        return $this->id;
    }

    public function institution_id(): Int
    {
        return $this->institution_id;
    }

    public function office_id(): Int
    {
        return $this->office_id;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function specialization(): String
    {
        return $this->specialization;
    }

    public function experience(): String
    {
        return $this->experience;
    }
    
    public function phone(): String
    {
        return $this->phone;
    }

    public function address(): String
    {
        return $this->address;
    }

    public function avatar_url(): String
    {
        return $this->avatar_url;
    }

    public function consultation_price(): Float
    {
        return $this->consultation_price;
    }

    public function in_place_price(): Float
    {
        return $this->in_place_price;
    }

    public function virtual_price(): Float
    {
        return $this->virtual_price;
    }

    public function bio(): String
    {
        return $this->bio;
    }

    public function chat_id(): String
    {
        return $this->chat_id;
    }

    public function status(): ?Int
    {
        return $this->status;
    }
}
