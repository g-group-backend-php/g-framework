<?php

namespace App\Controller;

use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response\JsonResponse;

class BookController
{
    #[Route(Method::GET, '/books/{id: \d+}')]
    public function show(int $id): JsonResponse
    {
        return new JsonResponse(200, [
            'id' => $id,
            'name' => 'Ojciec Chrzestny',
        ]);
    }

    #[Route(Method::GET, '/books')]
    public function index(): JsonResponse
    {
        return new JsonResponse(200, [
            [
                'id' => 1,
                'name' => 'Ojciec Chrzestny',
            ],
            [
                'id' => 2,
                'name' => 'Niespokojni Zmarli',
            ],
            [
                'id' => 3,
                'name' => 'Mistrz Czystego Kodu',
            ]
        ]);
    }
}
