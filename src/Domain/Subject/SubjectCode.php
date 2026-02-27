<?php

namespace App\Domain\Subject;

class SubjectCode{
    private String $code;
    function __construct(string $code){
        $this->code=$code;
    }
    function value(){
        return $this->code;
    }
}