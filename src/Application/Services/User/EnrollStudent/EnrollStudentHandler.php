<?php

namespace App\Application\Services\User\EnrollStudent;

use App\Application\Services\User\EnrollStudent\EnrollStudentCommand;
use App\Domain\Course\CourseCode;
use App\Domain\User\IUserRepository;
use App\Domain\Course\ICourseRepository;
use App\Domain\User\UserId;

final class EnrollStudentHandler
{
    private IUserRepository $userRepository;
    private ICourseRepository $courseRepository;

    public function __construct(IUserRepository $userRepository, ICourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    public function handle(EnrollStudentCommand $command): void 
    {
        $user = $this->userRepository->findById(new UserId($command->userId));
        
        if ($user === null) {
            throw new \InvalidArgumentException("User not found");
        }
        if ($user->Role() !== 'student') {
            throw new \InvalidArgumentException("Only students can be enrolled");
        }
        if ($command->courseCode !== null) {
            $course = $this->courseRepository->findByCode(new CourseCode($command->courseCode));
            
            if ($course === null) {
                throw new \InvalidArgumentException("Course not found");
            }

            $user->enrollStudent($course->getCodeCourse());
        }
        $this->userRepository->update($user);
    }
}