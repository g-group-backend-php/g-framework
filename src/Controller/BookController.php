<?php

namespace App\Controller;

use App\Service\ArrayService;
use App\Service\GlobeService;
use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response;

class BookController
{
    #[Route(Method::GET, '/books/{id: \d+}/page/{page: \d+}')]
    public function show(int $id, int $page): Response
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
