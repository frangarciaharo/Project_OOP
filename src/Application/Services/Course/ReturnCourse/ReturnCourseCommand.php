<?php

namespace App\Application\Services\Course\ReturnCourse;

class ReturnCourseCommand
{
    public function __construct( public readonly string $courseCode){
        
    }
}
