<?php

namespace App\Controller;

use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response\JsonResponse;

class UserController
{
    #[Route(Method::GET, '/users/1')]
    public function show(): JsonResponse
    {
        return new JsonResponse(200, [
            'id' => 1,
            'name' => 'Adam Malysz',
        ]);
    }

    #[Route(Method::GET, '/users')]
    public function index(): JsonResponse
    {
        return new JsonResponse(200, [
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
