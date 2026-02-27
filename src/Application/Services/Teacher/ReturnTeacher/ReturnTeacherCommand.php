<?php 

namespace App\Application\Services\Teacher\ReturnTeacher;

class ReturnTeacherCommand{
    public function __construct( public readonly string $teacherCode){
        
    }
}