<?php

namespace Tests\Domain\teacher;
use PHPUnit\Framework\TestCase;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherCode;

class ReturnTeacherDomainTest extends TestCase{

    public function test_return_teacher_by_code(): void{
        $userId = 1;
        $teacherCode = new TeacherCode('TCH-100');
        $teacher = new Teacher($teacherCode, $userId);

        $this->assertEquals('TCH-100', $teacher->code()->value());
        $this->assertEquals(1, $teacher->userId());
    }
}