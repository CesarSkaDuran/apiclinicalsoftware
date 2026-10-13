<?php

namespace HC\Histories\User\Infrastructure;

use App\User;
use HC\Histories\User\Domain\UserEntity;
use HC\Histories\User\Domain\UserRepository;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function find(Int $id): ?UserEntity
    {
        $response = $this->model->where('id', $id)->first();

        return $response ? UserEntity::fromArray($response->toArray()) : null;
    }

    public function create(UserEntity $entity): Int
    {
        $entityAsArray = $entity->toArray();

        if ($entityAsArray['password'] != null) {
            $entityAsArray['password'] = Hash::make($entityAsArray['password']);
        }

        $created = $this->model->create($entityAsArray);
        $created->chat_id = strtolower(str_replace(' ', '', $created->name)) . '_' . (string) $created->id;
        $created->save();

        return $created->id;
    }

    public function findByEmail(String $email): ?UserEntity
    {
        $response = $this->model->where('email', $email)->first();

        return $response ? UserEntity::fromArray($response->toArray()) : null;
    }
}
