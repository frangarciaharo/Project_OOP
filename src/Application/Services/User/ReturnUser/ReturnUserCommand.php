<?php

namespace App\Application\Services\User\ReturnUser;

class ReturnUserCommand
{
    public function __construct( public readonly string $userId){
        
    }
}
