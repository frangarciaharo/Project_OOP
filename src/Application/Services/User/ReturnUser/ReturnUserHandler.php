<?php

namespace App\Application\Services\User\ReturnUser;

use App\Domain\User\IUserRepository;
use App\Domain\User\UserId;
use App\Domain\User\User;

final class ReturnUserHandler
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ReturnUserCommand $command): User{
        $user = $this->userRepository->findById(
            new UserId($command->userId)
        );
        if ($user === null) {
            throw new \Exception("User not found");
        }
        return $user;
    }
}
