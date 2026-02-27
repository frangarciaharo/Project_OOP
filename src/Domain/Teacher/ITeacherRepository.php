<?php

namespace App\Domain\Teacher;

use App\Domain\Teacher\Teacher;
use App\Domain\Teacher\TeacherCode;

interface ITeacherRepository{
    public function save(Teacher $teacher):void;
    public function findByCode(TeacherCode $code):?Teacher;
    public function findAll():array;
}