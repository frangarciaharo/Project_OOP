<?php

namespace App\Application\Services\Subject\AssignTeacher;

use App\Domain\Subject\ISubjectRepository;
use App\Domain\Subject\SubjectCode;
use App\Domain\Teacher\ITeacherRepository;
use App\Domain\Teacher\TeacherCode;
use App\Application\Services\Subject\AssignTeacher\AssignTeacherSubjectCommand;

final class AssignTeacherSubjectHandler{

    private ITeacherRepository $teacherRepository;
    private ISubjectRepository $subjectRepository;

    public function __construct(ITeacherRepository $teacherRepository, ISubjectRepository $subjectRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function handle(AssignTeacherSubjectCommand $command): void 
    {
        $subject = $this->subjectRepository->findByid(new SubjectCode($command->subjectcode));

    
        if (!$subject) {
            throw new \InvalidArgumentException("Subject not found");
        }

        $teacher = $this->teacherRepository->findByCode(new TeacherCode($command->teachercode));
        if (!$teacher) {
            throw new \InvalidArgumentException("Teacher not found");
        }

        $subject->AssignTeacher(new TeacherCode($command->teachercode));
        $this->subjectRepository->save($subject);
    }
}