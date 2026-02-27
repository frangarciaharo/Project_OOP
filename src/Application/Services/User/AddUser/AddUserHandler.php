<?php

namespace App\Application\Services\User\AddUser;

use App\Domain\User\IUserRepository;
use App\Domain\User\User;
use App\Domain\User\UserId;

final class AddUserHandler {
    private IUserRepository $userRepository;
    
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(AddUserCommand $command): void{
        $user = new User(
            new UserId($command->userId),
            $command->name,
            $command->lastname,
            $command->email,
            $command->password,
            $command->dni,
            $command->role,
            $command->birthdate
        );
        $this->userRepository->save($user);
    }
}