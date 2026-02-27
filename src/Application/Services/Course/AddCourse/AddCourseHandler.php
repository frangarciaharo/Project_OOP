<?php

namespace App\Application\Services\Course\AddCourse;

use App\Domain\Course\Course;
use App\Domain\Course\CourseCode;
use App\Domain\Course\ICourseRepository;

final class AddCourseHandler {
    private ICourseRepository $courseRepository;
    
    public function __construct(ICourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(AddCourseCommand $command): void{
        $course = new Course(
            new CourseCode($command->courseId),
            $command->namecourse,
            $command->acronym,
            $command->duration
        );
        $this->courseRepository->save($course);
    }
}