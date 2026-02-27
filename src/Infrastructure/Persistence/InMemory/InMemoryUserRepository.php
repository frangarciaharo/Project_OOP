<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\IUserRepository;

class InMemoryUserRepository implements IUserRepository{
    private array $users = [];
    function save(User $user):void{
        $this->users[(string)$user->id()] = $user;
    }
    function findById(UserId $id): ?User
    {
        return $this->users[(string)$id] ?? null;
    }
    function findAll(): array{
        return array_values($this->users);
    }
}
