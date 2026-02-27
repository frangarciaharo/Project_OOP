<?php

namespace App\Domain\User;

use App\Domain\User\User;
use App\Domain\User\UserId;

interface IUserRepository{
    public function save(User $user):void;
    public function update(User $user):void;
    public function findById(UserId $id):?User;
    public function findAll():array;
}