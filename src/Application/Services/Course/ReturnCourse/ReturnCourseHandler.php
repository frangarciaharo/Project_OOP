<?php

namespace App\Application\Services\Course\ReturnCourse;

use App\Domain\Course\Course;
use App\Domain\Course\CourseCode;
use App\Domain\Course\ICourseRepository;
use App\Application\Services\Course\ReturnCourse\ReturnCourseCommand;

class ReturnCourseHandler {
    private ICourseRepository $courseRepository;

    public function __construct(ICourseRepository $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function handle(ReturnCourseCommand $command): Course {
        $course = $this->courseRepository->findByCode(
            new CourseCode($command->courseCode)
        );

        if (!$course) {
            throw new \Exception("Course not found");
        }

        return $course;
    }
}