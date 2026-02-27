<?php

namespace Tests\Application\user;
use App\Domain\User\IUserRepository;
use App\Application\Services\User\AddUser\AddUserCommand;
use App\Application\Services\User\AddUser\AddUserHandler;

use PHPUnit\Framework\TestCase;

class AddUserApplicationTest extends TestCase{

    public function test_user_can_be_add(): void{
        
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->once())->method('save');

        $handler = new AddUserHandler($userRepository);
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000'); 
        $handler->handle($command);

        $this->assertTrue(true);
    }  
    public function test_user_cant_be_add_with_empty_name(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Name cannot be empty");
        
        $command = new AddUserCommand('1', '', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }

    public function test_user_cant_be_add_with_invalid_name(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Name must be at least 3 characters long");
        
        $command = new AddUserCommand('1', 'Fr', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }

    public function test_user_cant_be_add_with_empty_lastname(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Lastname cannot be empty");
        
        $command = new AddUserCommand('1', 'Fran', '', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_invalid_lastname(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Lastname must be at least 4 characters long");
        
        $command = new AddUserCommand('1', 'Fran', 'gar', 'fran@gmail.com', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }

    public function test_user_cant_be_add_with_empty_email(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Email cannot be empty");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', '', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    } 

    public function test_user_cant_be_add_with_invalid_email(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid email");
        
       $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran', 'password123', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }

    public function test_user_cant_be_add_with_empty_password(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Password cannot be empty");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', '', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_invalid_password(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Password must be at least 6 characters long");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'pas', '12345678A', 'student', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_empty_dni(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("DNI cannot be empty");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '', 'student', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_invalid_dni(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid DNI format");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678', 'student', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_empty_role(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Role Empty");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', '', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_invalid_role(): void {
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid role specified");
        
        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'secretaria', '01-01-2000'); 

        $handler->handle($command);
    }
    public function test_user_cant_be_add_with_invalid_birthdate(): void{
        $userRepository = $this->createMock(IUserRepository::class);
        $userRepository->expects($this->never())->method('save');

        $handler = new AddUserHandler($userRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Birthdate must be in DD-MM-YYYY format");

        $command = new AddUserCommand('1', 'Fran', 'garcia haro', 'fran@gmail.com', 'password123', '12345678A', 'student', '2000-01-01'); 

        $handler->handle($command);
    }

}