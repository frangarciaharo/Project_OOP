<?php

namespace App\Application\Services\Subject\UnassignTeacher;

use App\Domain\Subject\ISubjectRepository;
use App\Domain\Subject\SubjectCode;

final class UnassignTeacherSubjectHandler {

    private ISubjectRepository $subjectRepository;

    public function __construct(ISubjectRepository $subjectRepository)
    {
        // Para desasignar, normalmente solo necesitas el repositorio de asignaturas
        $this->subjectRepository = $subjectRepository;
    }

    public function handle(UnAssingTeacherSubjectCommand $command): void 
    {
        $subjectCode = new SubjectCode($command->subjectcode);
        $subject = $this->subjectRepository->findByid($subjectCode);

        if (!$subject) {
            throw new \InvalidArgumentException("Subject not found");
        }
        $subject->UnassignTeacher();

        $this->subjectRepository->save($subject);
    }
}