<?php

namespace App\Application\Services\Teacher\AddTeacher;
use App\Domain\Teacher\ITeacherRepository;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherCode;
use App\Domain\User\IUserRepository;
use App\Domain\User\UserId;

final class AddTeacherHandler {
    private ITeacherRepository $teacherRepository;
    private IUserRepository $userRepository;
    
    public function __construct(ITeacherRepository $teacherRepository, IUserRepository $userRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(AddTeacherCommand $command): void 
    {

        $userId = new UserId($command->userId); 
        $user = $this->userRepository->findById($userId);

        if (!$user) {
            throw new \InvalidArgumentException("User not found");
        }

        $teacherCode = new TeacherCode($command->teachercode);
        $teacher = new Teacher($teacherCode, $userId); 
        $user->setRole('teacher');
        $this->teacherRepository->save($teacher);
        $this->userRepository->save($user);
    }
}