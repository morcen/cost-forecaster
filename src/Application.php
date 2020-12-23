<?php

namespace LSM;

use LSM\Controllers\BaseController;
use LSM\Services\RouteService;

class Application
{
    /**
     * @return ?BaseController
     * @throws \Exception
     */
    public function run(): ?BaseController
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $controller = RouteService::route($_SERVER['REQUEST_URI'], $method);
        if (in_array($method, ['POST', 'PUT'])) {
            $data = (array)json_decode(file_get_contents('php://input')) ?? $_POST ?? [];
            return (new $controller())($data);
        }

        return (new $controller())();
    }
}
