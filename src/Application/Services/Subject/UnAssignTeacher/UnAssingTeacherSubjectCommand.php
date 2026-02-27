<?php

namespace App\Application\Services\Subject\UnAssignTeacher;

class UnAssingTeacherSubjectCommand{
    public function __construct( 
        public readonly string $subjectcode, 
        public readonly string $teachercode,
    ){}
}