<?php

namespace App\Domain\Subject;

use App\Domain\Subject\Subject;
use App\Domain\Subject\SubjectCode;

interface ISubjectRepository{
    public function save(Subject $subject):void;
    public function findByid(SubjectCode $code):?Subject;
    public function findAll():array;
}