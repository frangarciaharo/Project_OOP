<?php

namespace App\Application\Services\User\EnrollStudent;

class EnrollStudentCommand
{
    public function __construct( 
        public readonly string $userId,
        public readonly string $courseCode 
    ){}
}