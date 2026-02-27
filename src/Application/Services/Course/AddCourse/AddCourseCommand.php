<?php

namespace App\Application\Services\Course\AddCourse;

class AddCourseCommand{
    public function __construct( 
        public readonly string $courseId, 
        public readonly string $namecourse,
        public readonly string $acronym,  
        public readonly int $duration
    ){}
}
