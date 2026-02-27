<?php

namespace App\Application\Services\User\AddUser;

class AddUserCommand{
    public function __construct( 
        public readonly string $userId, 
        public readonly string $name, 
        public readonly string $lastname, 
        public readonly string $email, 
        public readonly string $password,
        public readonly string $dni, 
        public readonly string $role, 
        public readonly string $birthdate
    ){}
}
