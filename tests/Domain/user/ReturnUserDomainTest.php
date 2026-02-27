<?php

namespace Tests\domain\user;

use PHPUnit\Framework\TestCase;
use App\Domain\User\User;
use App\Domain\User\UserId;

class ReturnUserDomainTest extends TestCase{
    public function test_return_user_by_id(): void
    {
        $userId = new UserId(1);
        $user = new User(
            $userId, 
            'Fran', 
            'Garcia', 
            'fran@gmail.com', 
            'pass123', 
            '12345678A', 
            'student', 
            '01-01-2000'
        );
        $this->assertEquals(1, $user->id()->value());
    }
    public function test_return_user_by_name(): void
    {
        $userId = new UserId(1);
        $user = new User(
            $userId, 
            'Fran', 
            'Garcia', 
            'fran@gmail.com', 
            'pass123', 
            '12345678A', 
            'student', 
            '01-01-2000'
        );
        $this->assertEquals('Fran', $user->name());
    }
}