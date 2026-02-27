<?php

namespace App\Domain\Teacher;

class TeacherCode{
    private String $code;
    function __construct(string $code){
        $this->code=$code;
    }
    function value(){
        return $this->code;
    }
}