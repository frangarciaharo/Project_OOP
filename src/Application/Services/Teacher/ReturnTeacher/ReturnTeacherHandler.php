<?php

namespace App\Application\Services\Teacher\ReturnTeacher;

use App\Domain\Teacher\ITeacherRepository;
use App\Domain\Teacher\TeacherCode;
use App\Domain\Teacher\Teacher;

final class ReturnTeacherHandler
{
    private ITeacherRepository $teacherRepository;

    public function __construct(ITeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function handle(ReturnTeacherCommand $command): Teacher{
        $user = $this->teacherRepository->findByCode(
            new TeacherCode($command->teacherCode)
        );
        if ($user === null) {
            throw new \Exception("Teacher not found");
        }
        return $user;
    }
}

