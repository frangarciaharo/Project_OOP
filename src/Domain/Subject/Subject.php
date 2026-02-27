<?php

namespace App\Domain\Subject;

use App\Domain\Teacher\TeacherCode;
use Doctrine\ORM\Mapping as Orm;


#[Orm\Entity]
#[Orm\Table(name: 'subjects')]
class Subject{
    #[Orm\Id, Orm\Column(type: 'string')]
    private SubjectCode $code;
    #[Orm\Column(type: 'string')]
    private string $namesubject;
    #[Orm\Column(type: 'string', nullable: true)]
    private ?string $teachercode = null;
    #[Orm\Column(type: 'integer')]
    private int $duration;

    
    public function __construct(SubjectCode $code, String $namesubject, int $duration)
    {
        $this->setCode($code);
        $this->setNamesubject($namesubject);
        $this->setDuration($duration);
    }

    
    public function getCode()
    {
        return $this->code;
    }

    public function setCode(SubjectCode $code): void
    {
        $this->code = $code;
    } 

    public function getNamesubject()
    {
        return $this->namesubject;
    }

    public function setNamesubject(String $namesubject): void
    {   
          if (empty(trim($namesubject))) {
            throw new \InvalidArgumentException("Subject cannot be empty");
        }
        if(strlen($namesubject) < 4){
            throw new \InvalidArgumentException("Subject must be at least 4 characters long");
        }
        $this->namesubject = $namesubject;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function setDuration(int $duration): void
    {
        if(strlen($duration) < 2){
            throw new \InvalidArgumentException("Duration min 2 valors: ex 10");
        }
        $this->duration = $duration;
    }

    public function Teachercode(){
        return $this->teachercode ? new TeacherCode($this->teachercode): null;
    }

    public function AssignTeacher(TeacherCode $teachercode):void{
        $this->teachercode = $teachercode->value();
    }
    public function UnassignTeacher(): void{
        $this->teachercode = null;
    }
}