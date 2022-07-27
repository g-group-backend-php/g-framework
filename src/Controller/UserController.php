<?php

namespace App\Controller;

use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response;

class UserController
{
    #[Route(Method::GET, '/users/1')]
    public function show(): Response
    {
        return new Response(200, [
            'id' => 1,
            'name' => 'Adam Malysz',
        ]);
    }

    #[Route(Method::GET, '/users')]
    public function index(): Response
    {
        return new Response(200, [
            [
                'id' => 1,
                'name' => 'Adam Malysz',
            ],
            [
                'id' => 2,
                'name' => 'Robert Kubica',
            ]
        ]);
    }
}
