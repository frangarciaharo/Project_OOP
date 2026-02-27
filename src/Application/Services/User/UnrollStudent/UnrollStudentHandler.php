<?php

namespace App\Application\Services\User\UnrollStudent;

use App\Application\Services\User\UnrollStudent\UnrollStudentCommand;
use App\Domain\User\IUserRepository;
use App\Domain\User\UserId;

final class UnrollStudentHandler{
    private IUserRepository $userRepository;


    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(UnrollStudentCommand $command): void{
        
        $user = $this->userRepository->findById(new UserId($command->userId));
        if ($user === null) {
            throw new \InvalidArgumentException("User not found");
        }

        $user->UnrollStudent();

        $this->userRepository->save($user);
    }
}