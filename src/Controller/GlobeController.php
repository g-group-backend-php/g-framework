<?php

namespace App\Controller;

use App\Service\GlobeService;
use Globe\Http\Model\Response;

class GlobeController
{
    public function show(GlobeService $service): Response
    {
        return new Response(200, $service->getMessage());
    }
}
