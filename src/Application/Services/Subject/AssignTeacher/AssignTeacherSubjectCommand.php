<?php

namespace App\Application\Services\Subject\AssignTeacher;

class AssignTeacherSubjectCommand{
    public function __construct( 
        public readonly string $subjectcode, 
        public readonly string $teachercode,
    ){}
}