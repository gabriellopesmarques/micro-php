<?php

namespace App\Controller;

use Core\Request;
use Core\Response;

class ExampleController
{
    public function index(Request $request, Response $response)
    {
        return $response->json([
            'timestamp' => time(),
            'response_json' => 'example'
        ]);
    }
}
