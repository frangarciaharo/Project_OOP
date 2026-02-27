<?php

namespace Tests\Application\user;
use App\Domain\User\IUserRepository;
use App\Domain\Course\ICourseRepository;
use App\Domain\Course\Course;
use App\Domain\Course\CourseCode;
use PHPUnit\Framework\TestCase;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Application\Services\User\EnrollStudent\EnrollStudentCommand;
use App\Application\Services\User\EnrollStudent\EnrollStudentHandler;

class EnrollUserApplicationTest extends TestCase{

    public function test_user_can_be_enroll_course(): void{
        
        $courseCode = 'DAW2025';

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000');
        $course = new Course(new CourseCode('DAW2025'), 'Desarrollo de Aplicaciones web', 'DAW', 2000); 

        $courseRepository = $this->createMock(ICourseRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $courseRepository->method('findByCode')->willReturn($course);
        $userRepository->method('findById')->willReturn($user);

        $userRepository->expects($this->once())->method('update');

        $handler = new EnrollStudentHandler($userRepository, $courseRepository);
        $command = new EnrollStudentCommand($user->id(), $course->getCodeCourse());

        $handler->handle($command);

        $this->assertEquals($courseCode, $user->coursecode());
    }  

    public function test_user_cant_be_enroll_course_because_inexist_coursecode(): void{

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000');
        $course = new Course(new CourseCode('DAW2025'), 'Desarrollo de Aplicaciones web', 'DAW', 2000); 

        $courseRepository = $this->createMock(ICourseRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $courseRepository->method('findByCode')->willReturn(null);
        $userRepository->method('findById')->willReturn($user);

        $userRepository->expects($this->never())->method('update');

        $handler = new EnrollStudentHandler($userRepository, $courseRepository);
        $command = new EnrollStudentCommand($user->id(), $course->getCodeCourse());


        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Course not found");

        $handler->handle($command);
    } 
    
    public function test_user_cant_be_enroll_course_because_inexist_user(): void{

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000');
        $course = new Course(new CourseCode('DAW2025'), 'Desarrollo de Aplicaciones web', 'DAW', 2000); 

        $courseRepository = $this->createMock(ICourseRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $courseRepository->method('findByCode')->willReturn($course);
        $userRepository->method('findById')->willReturn(null);

        $userRepository->expects($this->never())->method('update');

        $handler = new EnrollStudentHandler($userRepository, $courseRepository);
        $command = new EnrollStudentCommand($user->id(), $course->getCodeCourse());


        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("User not found");

        $handler->handle($command);
    }
        public function test_user_cant_be_enroll_course_because_rol_invalid_user(): void{

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'teacher', '01-01-2000');
        $course = new Course(new CourseCode('DAW2025'), 'Desarrollo de Aplicaciones web', 'DAW', 2000); 

        $courseRepository = $this->createMock(ICourseRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $courseRepository->method('findByCode')->willReturn($course);
        $userRepository->method('findById')->willReturn($user);

        $userRepository->expects($this->never())->method('update');

        $handler = new EnrollStudentHandler($userRepository, $courseRepository);
        $command = new EnrollStudentCommand($user->id(), $course->getCodeCourse());


        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Only students can be enrolled");

        $handler->handle($command);
    }      
}