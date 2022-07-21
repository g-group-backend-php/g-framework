<?php

namespace App\Controller;

use Globe\Http\Model\Response;

class AnotherGlobeController
{
    public function show(): Response
    {
        return new Response(200, null);
    }
}
