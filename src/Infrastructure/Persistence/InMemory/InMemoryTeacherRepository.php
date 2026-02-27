<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Teacher\TeacherCode;
use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\ITeacherRepository;

class InMemoryTeacherRepository implements ITeacherRepository{
    private array $teachers = [];
    function save(Teacher $teacher):void{
        $this->teachers[(string)$teacher->code()] = $teacher;
    }
    function findByCode(TeacherCode $code): ?Teacher
    {
        return $this->teachers[(string)$code] ?? null;
    }
    function findAll(): array{
        return array_values($this->teachers);
    }
}
