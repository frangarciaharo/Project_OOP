<?php

namespace Tests\Application\subject;

use App\Application\Services\Subject\AssignTeacher\AssignTeacherSubjectCommand;
use App\Application\Services\Subject\AssignTeacher\AssignTeacherSubjectHandler;
use App\Domain\Subject\ISubjectRepository;
use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectCode;
use App\Domain\Teacher\ITeacherRepository;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherCode;
use PHPUnit\Framework\TestCase;

class AssignTeacherApplicationTest extends TestCase{
    public function test_teacher_can_be_assign(): void {
        $subjectrepository = $this->createMock(ISubjectRepository::class);
        $teacherrepository = $this->createMock(ITeacherRepository::class);

        $handler = new AssignTeacherSubjectHandler($teacherrepository, $subjectrepository);


        $subjectcode = "S-200";
        $teachercode = "teacher-200";

        $subject = new Subject(new SubjectCode("S-200"), "Diseño de software", 10); 
        $subjectrepository->method('findByid')->willReturn($subject);


        $teacher= new Teacher(new TeacherCode("teacher-200"), "2");
        $teacherrepository->method('findByCode')->willReturn($teacher);

        $subjectrepository->expects($this->once())->method('save');

        $command = new AssignTeacherSubjectCommand($subjectcode, $teachercode);

        $handler->handle($command);

        $this->assertEquals($teachercode, $subject->Teachercode()->value());
    }
}