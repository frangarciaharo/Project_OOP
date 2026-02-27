<?php

namespace Tests\Application\user;
use App\Domain\User\IUserRepository;
use App\Domain\Course\CourseCode;
use PHPUnit\Framework\TestCase;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Application\Services\User\UnrollStudent\UnrollStudentCommand;
use App\Application\Services\User\UnrollStudent\UnrollStudentHandler;

class UnrollUserApplicationTest extends TestCase{

    public function test_user_can_be_unroll_course(): void{
        $userId = '1';

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000');
        $user->enrollStudent(new CourseCode("DAW2025"));

        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->method('findById')->willReturn($user);

        $userRepository->expects($this->once())->method('save');

        $handler = new UnrollStudentHandler($userRepository);
        $command = new UnrollStudentCommand($userId);

        $handler->handle($command);

        $this->assertNull($user->coursecode());
    }  
    
    public function test_user_cant_be_unroll_course(): void{
        $userId = '2';

        $user = new User(new UserId('1'), 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000');
        $user->enrollStudent(new CourseCode("DAW2025"));

        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->method('findById')->willReturn(null);

        $userRepository->expects($this->never())->method('save');

        $handler = new UnrollStudentHandler($userRepository);
        $command = new UnrollStudentCommand($userId);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("User not found");
        
        $handler->handle($command);
    }  
}