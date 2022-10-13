<?php

namespace App\Controller;

use Globe\Http\Attribute\Route;
use Globe\Http\Enum\Method;
use Globe\Http\Response\HtmlResponse;
use Globe\Http\Template;

class TemplateController
{
    #[Route(Method::GET, '/template/demo')]
    public function index()
    {
        $template = new Template();
        return new HtmlResponse(404,
            $template->render('demo.g.html', [
                'title' => '"wartosc zmiennej title"',
                'arrayka' => [
                    'key_1' => 1,
                    'key_2' => 2,
                    'key_3' => 3,
                    'key_4' => 4
                    ]
                ]
            )
        );
    }
}