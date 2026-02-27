<?php

namespace App\Application\Services\Subject\AddSubject;

class AddSubjectCommand{
    public function __construct( 
        public readonly string $subjectcode, 
        public readonly string $subjectname, 
        public readonly ?string $teachercode = null, 
        public readonly int $duration
    ){}
}
