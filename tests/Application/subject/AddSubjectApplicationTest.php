<?php

namespace Tests\Application\subject;
use PHPUnit\Framework\TestCase;
use App\Domain\Subject\ISubjectRepository;
use App\Application\Services\Subject\AddSubject\AddSubjectCommand;
use App\Application\Services\Subject\AddSubject\AddSubjectHandler;

class AddSubjectApplicationTest extends TestCase{

    public function test_subject_can_be_add(): void {
        $subjectrepository = $this->createMock(ISubjectRepository::class);
        $subjectrepository->expects($this->once())->method('save');

        $handler = new AddSubjectHandler( $subjectrepository);
        $command = new AddSubjectCommand("S-200", "Diseño de software", "teacher-200", 10); 
    
        $handler->handle($command);
        $this->assertTrue(true);
    }
    public function test_subject_cant_be_add_empty_name(): void {
        $subjectrepository = $this->createMock(ISubjectRepository::class);
        $subjectrepository->expects($this->never())->method('save');

        $handler = new AddSubjectHandler($subjectrepository);
        $command = new AddSubjectCommand("S-200", "", "teacher-200", 10); 
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Subject cannot be empty");
        $handler->handle($command);
    }
    public function test_subject_cant_be_add_invalid_name(): void {
        $subjectrepository = $this->createMock(ISubjectRepository::class);
        $subjectrepository->expects($this->never())->method('save');

        $handler = new AddSubjectHandler($subjectrepository);
        $command = new AddSubjectCommand("S-200", "aa", "teacher-200", 10); 
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Subject must be at least 4 characters long");
        $handler->handle($command);
    }
    public function test_subject_cant_be_add_empty_duration(): void {
        $subjectrepository = $this->createMock(ISubjectRepository::class);
        $subjectrepository->expects($this->never())->method('save');

        $handler = new AddSubjectHandler($subjectrepository);
        $command = new AddSubjectCommand("S-200", "Diseño de software", "teacher-200", 00); 
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Duration min 2 valors: ex 10");
        $handler->handle($command);
    }
}