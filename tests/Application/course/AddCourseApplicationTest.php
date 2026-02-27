<?php

namespace Tests\Application\course;
use PHPUnit\Framework\TestCase;
use App\Domain\Course\ICourseRepository;
use App\Application\Services\Course\AddCourse\AddCourseCommand;
use App\Application\Services\Course\AddCourse\AddCourseHandler;

class AddCourseApplicationTest extends TestCase{
    public function test_course_can_be_add(): void{
        
        $courseRepository = $this->createMock(ICourseRepository::class);
        $courseRepository->expects($this->once())->method('save');

        $handler = new AddCourseHandler($courseRepository);
        $command = new AddCourseCommand('DAW2025', 'Desarrollo de Aplicaciones web', 'DAW', 2000); 
        $handler->handle($command);

        $this->assertTrue(true);
    }
    public function test_course_cant_be_add_with_empty_namecourse(): void{
        
        $courseRepository = $this->createMock(ICourseRepository::class);
        $courseRepository->expects($this->never())->method('save');

        $handler = new AddCourseHandler($courseRepository);

          
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("NameCourse cannot be empty");

        $command = new AddCourseCommand('DAW2025', '', 'DAW', 2000); 
        $handler->handle($command);
    }
    public function test_course_cant_be_add_with_invalid_namecourse(): void{
        
        $courseRepository = $this->createMock(ICourseRepository::class);
        $courseRepository->expects($this->never())->method('save');

        $handler = new AddCourseHandler($courseRepository);

          
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("NameCourse must be at least 3 characters long");

        $command = new AddCourseCommand('DAW2025', 'In', 'DAW', 2000); 
        $handler->handle($command);
    }
    public function test_course_cant_be_add_with_invalid_acronym(): void{
        
        $courseRepository = $this->createMock(ICourseRepository::class);
        $courseRepository->expects($this->never())->method('save');

        $handler = new AddCourseHandler($courseRepository);

          
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Acronym must be at least 3 characters long and max 4 characters");

        $command = new AddCourseCommand('DAW2025', 'Desarrollo de Aplicaciones web', 'GMSMIX', 2000); 
        $handler->handle($command);
    }
    public function test_course_cant_be_add_with_empty_acronym(): void{
        
        $courseRepository = $this->createMock(ICourseRepository::class);
        $courseRepository->expects($this->never())->method('save');

        $handler = new AddCourseHandler($courseRepository);

          
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Acronym cannot be empty");

        $command = new AddCourseCommand('DAW2025', 'Desarrollo de Aplicaciones web', '', 2000); 
        $handler->handle($command);
    }          
}