<?php

namespace App\Controller;

use App\Service\GlobeService;

class GlobeController
{
    public function show(GlobeService $service): void
    {
        echo json_encode($service->getMessage());
    }
}
