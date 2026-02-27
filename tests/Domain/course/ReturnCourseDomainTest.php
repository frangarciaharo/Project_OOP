<?php

namespace Tests\domain\user;

use PHPUnit\Framework\TestCase;
use App\Domain\Course\Course;
use App\Domain\Course\CourseCode;

class ReturnCourseDomainTest extends TestCase{
    public function test_return_course_by_coursecode(): void
    {
        $CourseCode = new CourseCode('DAW2025');
        $course = new Course(
            $CourseCode, 
            'Desarrollo de aplicaciones Web', 
            'DAW', 
            2000, 
        );
        $this->assertEquals('DAW2025', $course->getCodeCourse());
    }
    public function test_return_course_by_namecourse(): void
    {
        $CourseCode = new CourseCode('DAW2025');
        $course = new Course(
            $CourseCode, 
            'Desarrollo de aplicaciones Web', 
            'DAW', 
            2000, 
        );
        $this->assertEquals('Desarrollo de aplicaciones Web', $course->getNameCourse());
    }
    public function test_return_course_by_acronym(): void
    {
        $CourseCode = new CourseCode('DAW2025');
        $course = new Course(
            $CourseCode, 
            'Desarrollo de aplicaciones Web', 
            'DAW', 
            2000, 
        );
        $this->assertEquals('DAW', $course->getAcronym());
    }
}