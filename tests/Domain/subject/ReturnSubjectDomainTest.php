<?php

namespace Tests\Domain\subject;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectCode;
use PHPUnit\Framework\TestCase;

class ReturnSubjectDomainTest extends TestCase{

    public function test_return_subject_by_subjectcode(): void{
        $subjectcode = new SubjectCode("S-200");
        $subject = new Subject($subjectcode , "Diseño de software", 10);
        $this->assertEquals("S-200", $subject->getCode()->value());
    }
    public function test_return_subject_by_subjectname(): void{
        $subjectcode = new SubjectCode("S-200");
        $subject = new Subject($subjectcode , "Diseño de software", 10);
        $this->assertEquals("Diseño de software", $subject->getNamesubject());
    }
}