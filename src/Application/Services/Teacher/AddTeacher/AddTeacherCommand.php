<?php

namespace App\Application\Services\Teacher\AddTeacher;

class AddTeacherCommand{
    public function __construct( 
        public readonly string $userId, 
        public readonly string $teachercode
    ){}
}