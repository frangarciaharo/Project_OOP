<?php

namespace App\Application\Services\User\UnrollStudent;

class UnrollStudentCommand
{
    public function __construct( 
        public readonly string $userId,
    ){}
}