<?php

namespace Tests\Application\teacher;
use PHPUnit\Framework\TestCase;
use App\Domain\User\IUserRepository;
use App\Domain\Teacher\ITeacherRepository;
use App\Application\Services\Teacher\AddTeacher\AddTeacherCommand;
use App\Application\Services\Teacher\AddTeacher\AddTeacherHandler;
use App\Domain\User\User;
use App\Domain\User\UserId;

class AddTeacherApplicationTest extends TestCase{

    public function test_teacher_can_be_added_to_existing_user(): void{
        $userRepository = $this->createMock(IUserRepository::class);
        $teacherRepository = $this->createMock(ITeacherRepository::class);

        $userId = new UserId(1);
        $user = new User($userId, 'Fran', 'garcia haro', 'fran@gmail.com', 'pass123', '12345678A', 'student', '01-01-2000');
        $userRepository->method('findById')->with($userId)->willReturn($user);

        $teacherRepository->expects($this->once())->method('save');
        $userRepository->expects($this->once())->method('save');

        $handler = new AddTeacherHandler($teacherRepository, $userRepository);
        $command = new AddTeacherCommand($userId, 'TCH-100'); 
        
        $handler->handle($command);

        $this->assertEquals('teacher', $user->role());
    }
    
    public function test_teacher_cannot_be_added_to_missing_user(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $teacherRepository = $this->createMock(ITeacherRepository::class);

        $userId = new UserId(1);

        $userRepository->method('findById')->with($userId)->willReturn(null);

        $teacherRepository->expects($this->never())->method('save');
        $userRepository->expects($this->never())->method('save');

        $handler = new AddTeacherHandler($teacherRepository, $userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("User not found");

        $command = new AddTeacherCommand($userId, 'TCH-100'); 
        
        $handler->handle($command);
    }

}