<?php

namespace HC\Histories\Appointment\Domain;

final class AppointmentEntity
{
    private ?Int $id;
    private ?Int $user_id;
    private ?Int $app_user_id;
    private ?Int $remision_id;
    private String $name;
    private ?String $company;
    private String $value;
    private ?String $reason;
    private String $date;
    private String $time;
    private ?String $phone_confirmation;
    private ?String $email_confirmation;
    private ?Int $payment_type;
    private ?Int $status;
    private ?String $endTime;
    private ?Int $patient_id;
    private Int $type;

    private int $DEFAULT_STATUS = 2;

    public function __construct(?Int $id, ?Int $user_id, ?Int $app_user_id, Int $remision_id, String $name, ?String $company, String $value, ?String $reason, String $date, String $time, ?String $phone_confirmation, ?String $email_confirmation, ?Int $payment_type, ?Int $status, ?String $endTime, ?Int $patient_id, Int $type)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->app_user_id = $app_user_id;
        $this->remision_id = $remision_id;
        $this->name = $name;
        $this->company = $company;
        $this->value = $value;
        $this->reason = $reason;
        $this->date = $date;
        $this->time = $time;
        $this->phone_confirmation = $phone_confirmation;
        $this->email_confirmation = $email_confirmation;
        $this->payment_type = $payment_type;
        $this->status = $status != null ? $status : $this->DEFAULT_STATUS;
        $this->endTime = $endTime;
        $this->patient_id = $patient_id;
        $this->type = $type;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? $data['id'] : null,
            isset($data['user_id']) ? $data['user_id'] : null,
            isset($data['app_user_id']) ? $data['app_user_id'] : null,
            isset($data['remision_id']) ? $data['remision_id'] : null,
            $data['name'],
            isset($data['company']) ? $data['company'] : null,
            $data['value'],
            isset($data['reason']) ? $data['reason'] : null,
            $data['date'],
            $data['time'],
            isset($data['phone_confirmation']) ? $data['phone_confirmation'] : null,
            isset($data['email_confirmation']) ? $data['email_confirmation'] : null,
            isset($data['payment_type']) ? $data['payment_type'] : null,
            isset($data['status']) ? $data['status'] : null,
            isset($data['end_time']) ? $data['end_time'] : null,
            isset($data['patient_id']) ? $data['patient_id'] : null,
            $data['type']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'app_user_id' => $this->app_user_id,
            'remision_id' => $this->remision_id,
            'patient_id' => $this->patient_id,
            'name' => $this->name,
            'company' => $this->company,
            'value' => $this->value,
            'reason' => $this->reason,
            'date' => $this->date,
            'end_time' => $this->endTime,
            'time' => $this->time,
            'phone_confirmation' => $this->phone_confirmation,
            'email_confirmation' => $this->email_confirmation,
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'type' => $this->type
        ];
    }

    public function id(): ?Int
    {
        return $this->id;
    }

    public function user_id(): ?Int
    {
        return $this->user_id;
    }

    public function app_user_id(): ?Int
    {
        return $this->app_user_id;
    }

    public function remision_id(): ?Int
    {
        return $this->remision_id;
    }


    public function patient_id(): ?Int
    {
        return $this->patient_id;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function company(): ?String
    {
        return $this->company;
    }

    public function value(): String
    {
        return $this->value;
    }

    public function reason(): String
    {
        return $this->reason;
    }

    public function date(): String
    {
        return $this->date;
    }

    public function time(): String
    {
        return $this->time;
    }

    public function end_time(): ?String
    {
        return $this->endTime;
    }

    public function phone_confirmation(): ?String
    {
        return $this->phone_confirmation;
    }

    public function email_confirmation(): ?String
    {
        return $this->email_confirmation;
    }

    public function payment_type(): ?Int
    {
        return $this->payment_type;
    }

    public function status(): ?Int
    {
        return $this->status;
    }



}
