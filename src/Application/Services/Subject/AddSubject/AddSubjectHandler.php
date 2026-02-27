<?php

namespace App\Application\Services\Subject\AddSubject;
use App\Domain\Subject\ISubjectRepository;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectCode;
use App\Domain\Teacher\TeacherCode;

final class AddSubjectHandler {
    private ISubjectRepository $subjectRepository;
    
    public function __construct(ISubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function handle(AddSubjectCommand $command): void{
        if($this->subjectRepository->findByid(new SubjectCode($command->subjectcode))){
            throw new \InvalidArgumentException("Subject is exist");
        }
        $subject = new Subject(
            new SubjectCode($command->subjectcode),
            $command->subjectname,
            $command->duration
        );
        if($command->teachercode){
            $subject->AssignTeacher(new TeacherCode($command->teachercode));
        }
        $this->subjectRepository->save($subject);
    }
}