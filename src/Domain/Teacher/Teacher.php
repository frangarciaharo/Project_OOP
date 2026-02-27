<?php

namespace App\Domain\Teacher;

use App\Domain\User\UserId;
use Doctrine\ORM\Mapping as Orm;

#[Orm\Entity]
#[Orm\Table(name: 'teachers')]
class Teacher{
    #[Orm\Id, Orm\Column(type: 'String')]
    private TeacherCode $code;
    #[Orm\Column(type: 'string'),]
    private string $userid;

    public function __construct(TeacherCode $code, string $userid){
        $this->code=$code;
        $this->userid=$userid;
    }

    public function setCode(TeacherCode $code): void
    {
        $stringValue = $code->value();

        if (empty(trim($stringValue))) {
            throw new \InvalidArgumentException("TeacherCode cannot be empty");
        }
        if (strlen($stringValue) < 1) {
            throw new \InvalidArgumentException("TeacherCode min 1");
        }

        $this->code = $code;
    }

    public function code(): TeacherCode
    {
        return $this->code;
    }

    public function userid(): string
    {   
        return $this->userid;
    }
}