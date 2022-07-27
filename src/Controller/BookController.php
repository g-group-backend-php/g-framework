<?php

namespace App\Controller;

use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response;

class BookController
{
    #[Route(Method::GET, '/books/{id}')]
    public function show(): Response
    {
        return new Response(200, [
            'id' => 1,
            'name' => 'Ojciec Chrzestny',
        ]);
    }

    #[Route(Method::GET, '/books')]
    public function index(): Response
    {
        return new Response(200, [
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
