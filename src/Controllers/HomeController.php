<?php

namespace App\Controllers;
use App\Infrastructure\Http\Response;
use App\Domain\User\User;

class HomeController
{
    public function index()
    {
        $user = new User("1", "Pep", "pep@pep.com");

        $response=new Response();
        $response->html('home', ['user'=>$user]);
    }

    public function login()
    {
        echo 'login';
    }
}
